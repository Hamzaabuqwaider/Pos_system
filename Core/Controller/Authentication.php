<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\User;

class Authentication extends Controller
{

    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }

    function __construct()
    {
        $this->admin_view(false);
        if (isset($_SESSION['user'])) {
            Helper::redirect('/dashboard');
        }
    }

    /**
     * Displays login form
     *
     * @return void
     */
    public function login()
    {
        $this->view = 'login';
    }

    /**
     * Login Validation
     *! validation from input username and pssword
     *! check if the username is empty
     *! check if the password is empty
     *! check if the username or paswsord is correct
     * @return void
     */


    public function validate()
    {
        // if user doesn't exists, do not authenticate
        $user = new User();

        if (empty($_POST['username'])) {
            $this->invalid_redirect("The username is required");
            $_SESSION['error_type'] = "error";
            die;
        }

        if (empty($_POST['password'])) {
            $this->invalid_redirect("The password is required");
            $_SESSION['error_type'] = "error";
            die;
        }

        $logged_in_user = $user->check_username(\htmlspecialchars($_POST['username']));


        if (!$logged_in_user) {
            $this->invalid_redirect("Invalid Username or Password");
            $_SESSION['error_type'] = "error";
        }


        //! check if the hash password in the database equal user_input password
        if (!\password_verify(\htmlspecialchars($_POST['password']), $logged_in_user->password)) {
            $this->invalid_redirect("Invalid Username or Password");
            $_SESSION['error_type'] = "error";
        }


        //! Check if the user has permissions to access the site
        if (empty($logged_in_user->permissions)) {
            $this->invalid_redirect("You don't have Access to the Website");
            $_SESSION['error_type'] = "error";
        }

        //! give coockie the user_logged if the user check the input remember me in the login page
        if (isset($_POST['remember_me'])) {
            // DO NOT ADD USER ID TO THE COOKIES - SECURITY BREACH!!!!!
            \setcookie('user_id', $logged_in_user->id, time() + (86400 * 30)); // 86400 = 1 day (60*60*24)
        }

        $_SESSION['user'] = array(
            'username' => $logged_in_user->username,
            'display_name' => $logged_in_user->display_name,
            'user_id' => $logged_in_user->id,
            'is_admin_view' => true
        );
        $_SESSION['error_type'] = "success";
        $_SESSION['message'] = 'Logged in successfully';


        //*extract all permissions from database to user logged
        $permissions = \unserialize($logged_in_user->permissions);

        //! Update in databse if user login and update the value status of Online
        $id = $_SESSION['user']['user_id'];
        $sql = "UPDATE users SET status = 'Online' WHERE id = $id";
        $user->connection->query($sql);


        //*check whether these permissions are available to the user to transfer him to the appropriate page
        if (in_array('user:read', $permissions)) {
            Helper::redirect('/dashboard');
            die;
        }
        if (in_array('seller:read', $permissions)) {
            Helper::redirect('/transactions/page');
            die;
        }

        if (in_array('item:read', $permissions)) {
            Helper::redirect('/items');
            die;
        }

        if (in_array('account:read', $permissions)) {
            Helper::redirect('/accounts/page');
            die;
        }
    }


    public function logout()
    {
        //! Update in databse if user login and update the value status of Offline

        $user = new User();
        $id = $_SESSION['user']['user_id'];
        $sql = "UPDATE users SET status = 'Offline',loggout_user = now() WHERE id = $id";
        $user->connection->query($sql);
        \session_destroy();
        \session_unset();
        \setcookie('user_id', '', time() - 3600); // destroy the cookie by setting a past expiry date
        Helper::redirect('/');
    }

    private function invalid_redirect($msg)
    {
        $_SESSION['message'] = $msg;
        Helper::redirect('/');
        die;
    }
}
