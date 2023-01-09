<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Helpers\Tests;
use Core\Model\User;

class Users extends Controller
{
        use Tests;
        public function render()
        {
                if (!empty($this->view))
                        $this->view();
        }

        function __construct()
        {
                $this->auth();
                $this->admin_view(true);
        }

        /**
         * Gets all users
         *
         * @return array
         */
        public function index()
        {
                $this->permissions(['user:read']);
                $this->view = 'users.index';
                $user = new User; // new model User.
                $this->data['users'] = $user->get_all();
                $this->data['users_count'] = count($user->get_all());
        }

        /**
         *! Display the HTML view page single and return data each user 
         */
        public function single()
        {
                $this->permissions(['user:read']);
                $this->view = 'users.single';
                $user = new User();
                $user_by_id =  $user->get_by_id($_GET['id']);

                if (!empty($user_by_id)) {
                        $date_created = new \DateTime($user_by_id->created_at);
                        $user_by_id->created_at = $date_created->format('d/m/Y');
                        $date_updated = new \DateTime($user_by_id->updated_at);
                        $user_by_id->updated_at = $date_updated->format('d/m/Y');
                        $this->data['user'] =  $user_by_id;
                } else {
                        $_SESSION['message'] = "No user by this id";
                        $_SESSION['error_type'] = "error";
                        Helper::redirect('/users');
                        die;
                }
        }

        /**
         *! Display the HTML form for user creation
         *
         * @return void
         */
        public function create()
        {
                $this->permissions(['user:create']);
                $this->view = 'users.create';
        }

        /**
         *! Creates new user
         *
         * @return void
         */
        public function store()
        {
                $this->permissions(['user:create']);

                if (empty($_POST['username'])) {
                        $_SESSION['message'] = "The username is required";
                        $_SESSION['error_type'] = "error";
                        Helper::redirect('/users/create');
                        die;
                }

                if (empty($_POST['display_name'])) {
                        $_SESSION['message'] = "The display is required";
                        $_SESSION['error_type'] = "error";
                        Helper::redirect('/users/create');

                        die;
                }

                if (empty($_POST['email'])) {
                        $_SESSION['message'] = "The email is required";
                        $_SESSION['error_type'] = "error";
                        Helper::redirect('/users/create');
                        die;
                }
                if (empty($_POST['password'])) {
                        $_SESSION['message'] = "The password is required";
                        $_SESSION['error_type'] = "error";
                        Helper::redirect('/users/create');
                        die;
                }

                /**
                 *! check if the user input email is exists in database 
                 *! error This email already exists 
                 */
                $user = new User();
                $users = $user->get_all();
                $users_email = array();
                foreach ($users as $user_id) {
                        array_push($users_email, $user_id->email);
                }

                if (in_array($_POST['email'], $users_email)) {
                        $_SESSION['message'] = "This email already exists";
                        $_SESSION['error_type'] = "error";
                        Helper::redirect('/users/create');
                        die;
                }

                $_POST['username'] =  \htmlspecialchars($_POST['username']);
                $_POST['display_name'] =  \htmlspecialchars($_POST['display_name']);
                $_POST['email'] =  \htmlspecialchars($_POST['email']);

                $permissions = null;
                switch ($_POST['role']) {
                        case 'admin':
                                $permissions = User::ADMIN;
                                break;

                        case 'procurement':
                                $permissions = User::PROCUREMENT;
                                break;

                        case 'seller':
                                $permissions = User::SELLER;
                                break;

                        case 'account':
                                $permissions = User::ACCOUNT;
                                break;
                }
                unset($_POST['role']);
                $_POST['permissions'] = \serialize($permissions);

                $result = self::check_empty_user();
                if ($result) {
                        $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT);
                        $user->create($_POST);
                        $_SESSION['error_type'] = "success";
                        $_SESSION['message'] = 'user Created';
                        Helper::redirect('/users');
                }
        }

        /**
         *
         *! Display the HTML form for user update
         *
         * @return void
         */
        public function edit()
        {
                $this->permissions(['user:read', 'user:update']);
                $this->view = 'users.edit';
                $user = new User();
                $user_by_id = $user->get_by_id($_GET['id']);
                if (!empty($user_by_id)) {

                        $this->data['user'] = $user->get_by_id($_GET['id']);
                } else {
                        $_SESSION['message'] = "No User for this id";
                        $_SESSION['error_type'] = "error";
                        Helper::redirect('/users');
                        die;
                }
        }

        /**
         *! Updates the user
         *
         * @return void
         */
        public function update()
        {
                $this->permissions(['user:read', 'user:update']);

                $user = new User();
                $user_info = $user->get_by_id($_POST['id']);

                $permissions = null;
                switch ($_POST['role']) {
                        case 'admin':
                                $permissions = User::ADMIN;
                                break;

                        case 'procurement':
                                $permissions = User::PROCUREMENT;
                                break;

                        case 'seller':
                                $permissions = User::SELLER;
                                break;

                        case 'account':
                                $permissions = User::ACCOUNT;
                                break;
                }
                unset($_POST['role']);
                $_POST['permissions'] = \serialize($permissions);
                $password_new = empty($_POST['new-password']) ? NULL : \password_hash($_POST['new-password'], \PASSWORD_DEFAULT);
                $_POST['password'] = empty($_POST['new-password']) ? $user_info->password : $password_new;
                unset($_POST['new-password']);
                $user->update($_POST);
                $_SESSION['error_type'] = "success";
                $_SESSION['message'] = 'user updated';
                Helper::redirect('/user?id=' . $_POST['id']);
        }

        /**
         *! Updates the user img profile
         *
         * @return void
         */

        public function update_img()
        {
                if (!empty($_FILES)) {
                        $targetDir =  "./resources/Images/";
                        $fileName = basename($_FILES["upload"]["name"]);
                        $user = new User;
                        move_uploaded_file($_FILES['upload']['tmp_name'],  $targetDir . $fileName);
                        if (!empty($fileName)) {
                                $user_id = $_SESSION['user']['user_id'];
                                $sql = "UPDATE users SET img='$fileName' WHERE id=$user_id";
                                $user->connection->query($sql);
                                $_SESSION['error_type'] = "success";
                                $_SESSION['message'] = 'img user updated';
                                Helper::redirect('/user/profile');
                        } else {

                                $_SESSION['error_type'] = "success";
                                $_SESSION['message'] = 'img user updated';
                                Helper::redirect('/user/profile');
                        }
                }
        }

        /**
         *! Delete the user
         *
         * @return void
         */
        public function delete()
        {
                $this->permissions(['user:delete']);

                $user = new User();
                $user->delete($_GET['id']);
                $_SESSION['error_type'] = "success";
                $_SESSION['message'] = 'user deleted';
                Helper::redirect('/users');
        }


        /**
         *
         *! Display the HTML form for user profile 
         *
         * @return void
         */
        public function profile()
        {
                $this->view = 'users.user-profile';
                $user = new User();
                $selected_user = $user->get_by_id($_SESSION['user']['user_id']);
                $this->data['info'] = $selected_user;
                $date_create = new \DateTime($selected_user->created_at);
                $date_update = new \DateTime($selected_user->updated_at);
                $selected_user->created_at = $date_create->format('d/m/Y');
                $selected_user->updated_at = $date_update->format('d/m/Y');
        }

        /**
         * @return void
         *! return view page and send data user loggen in to the page view 
         */

        public function edit_profile()
        {
                $this->view = 'users.edit_profile';
                $user = new User();
                $this->data['info'] = $user->get_by_id($_GET['id']);
        }

        /**
         * @return void
         ** Function update the user information, 
         ** And update password when send new post password 
         */

        public function update_profile()
        {
                $user = new User();
                $user_info = $user->get_by_id($_POST['id']);


                $_POST['username'] =  \htmlspecialchars($_POST['username']);
                $_POST['display_name'] =  \htmlspecialchars($_POST['display_name']);
                $_POST['email'] =  \htmlspecialchars($_POST['email']);
                $password_new = empty($_POST['new-password']) ? NULL : \password_hash($_POST['new-password'], \PASSWORD_DEFAULT);
                $_POST['password'] = empty($_POST['new-password']) ? $user_info->password : $password_new;
                unset($_POST['new-password']);
                $user->update($_POST);
                $_SESSION['error_type'] = "success";
                $_SESSION['message'] = 'user updated';
                Helper::redirect('/user/profile?id=' . $_POST['id']);
        }
}
