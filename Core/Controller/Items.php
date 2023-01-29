<?php

namespace Core\Controller;

use Core\Base\View;
use Core\Model\Item;
use Core\Helpers\Tests;
use Core\Helpers\Helper;
use Core\Base\Controller;

class Items extends Controller
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

    ///
    /**
     * Gets all items
     *
     * @return array 
     * return all of items in database 
     * and return count of row in tabel items in db
     */
    public function index()
    {
        $this->permissions(['item:read']);
        $this->view = 'items.index';
        $item = new Item; // new model post.
        $this->data['items'] = $item->get_all();
        $this->data['items_count'] = count($item->get_all());
    }

    /**
     * Undocumented function
     *
     * @return array
     *! return view page and data to the page view 
     */
    public function single()
    {
        $this->permissions(['item:read']);
        $this->view = 'items.single';
        $item = new Item();
        $item_by_id = $item->get_by_id($_GET['id']);
        if (!empty($item_by_id)) {
            $date = new \DateTime($item_by_id->created_at);
            $item_by_id->created_at = $date->format('d/m/Y');
            $this->data['item'] =  $item_by_id;
        } else {
            $_SESSION['message'] = "No item by this id";
            $_SESSION['error_type'] = "error";
            Helper::redirect('/items');
            die;
        }
    }

    /**
     * Display the HTML form for item creation
     *
     * @return void
     *! return view page
     */
    public function create()
    {
        $this->permissions(['item:create']);
        $this->view = 'items.create';
    }

    /**
     * Creates new Item
     *
     * @return void
     ** store the input required in the table items 
     ** Check all input for XSS vulnerabilities before saving in Database
     */
    public function store()
    {
        $this->permissions(['item:create']);


        if (empty($_POST['title'])) {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'The title is required';
            Helper::redirect('/items/create');
            die;
        }

        if (empty($_POST['cost'])) {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'The cost is required';
            Helper::redirect('/items/create');
            die;
        }

        if (empty($_POST['price'])) {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'The price is required';
            Helper::redirect('/items/create');
            die;
        }
        if (empty($_POST['quantity'])) {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'The quantity is required';
            Helper::redirect('/items/create');
            die;
        }

        $item = new Item();
        $items = $item->get_all();
        $items_name_all = array();
        foreach ($items as $item_name) {
            array_push($items_name_all, $item_name->title);
        }





        if (in_array($_POST['title'], $items_name_all)) {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'The item is already exist';
            Helper::redirect('/items/create');
            die;
        }
        $_POST['user_id'] = $_SESSION['user']['user_id'];
        $_POST['title'] =  \htmlspecialchars($_POST['title']);
        $_POST['cost'] =  \htmlspecialchars($_POST['cost']);
        $_POST['price'] =  \htmlspecialchars($_POST['price']);
        $_POST['quantity'] =  \htmlspecialchars($_POST['quantity']);
        $_POST['description'] =  \htmlspecialchars($_POST['description']);
        $targetDir =  "./resources/images_item/";
        $fileName = basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES['img']['tmp_name'],  $targetDir . $fileName);
        $_POST['img'] = $fileName;

        $result = self::check_empty();
        if ($result) {
            $item->create($_POST);
            $_SESSION['error_type'] = "success";
            $_SESSION['message'] = 'Item Created';
            Helper::redirect('/items');
        }
    }

    /**
     * Display the HTML form for Item update
     *
     * @return array
     *! return view page and data to the page view 
     */
    public function edit()
    {
        $this->permissions(['item:read', 'item:update']);
        $this->view = 'items.edit';
        $item = new Item();
        $selected_item = $item->get_by_id($_GET['id']);
        if (isset($selected_item)) {

            $this->data['item'] = $selected_item;
        } else {
            $_SESSION['message'] = "No item by this id";
            $_SESSION['error_type'] = "error";
            Helper::redirect('/items');
            die;
        }
    }

    /**
     * Updates the Item
     *
     * @return void
     *!  update the input required in the table items 
     ** Check all input for XSS vulnerabilities before update in Database
     */
    public function update()
    {
        $this->permissions(['item:read', 'item:update']);

        $item = new Item();
        $item_id = $_POST['id'];
        $_POST['title'] =  \htmlspecialchars($_POST['title']);
        $_POST['cost'] =  \htmlspecialchars($_POST['cost']);
        $_POST['price'] =  \htmlspecialchars($_POST['price']);
        $_POST['quantity'] =  \htmlspecialchars($_POST['quantity']);
        $_POST['description'] =  \htmlspecialchars($_POST['description']);


        if (empty($_POST['title'])) {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'The title can not be empty';
            Helper::redirect('edit?id=' . $_POST['id']);
            die;
        } elseif (empty($_POST['cost'])) {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'The cost can not be empty';
            Helper::redirect('edit?id=' . $_POST['id']);
            die;
        } elseif (empty($_POST['price'])) {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'The price can not be empty';
            Helper::redirect('edit?id=' . $_POST['id']);
            die;
        } elseif (empty($_POST['quantity'])) {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'The quantity can not be empty';
            Helper::redirect('edit?id=' . $_POST['id']);
            die;
        }
        $item->update($_POST);
        $_SESSION['error_type'] = "success";
        $_SESSION['message'] = 'Item Updated';

        Helper::redirect('/item?id=' . $_POST['id']);
    }

    /**
     * Delete the Item
     *
     * @return void
     *! delete the item by id request in url from table items 
     */
    public function delete()
    {

        $this->permissions(['item:read', 'item:delete']);
        $item = new Item();
        $item->delete($_GET['id']);
        $_SESSION['error_type'] = "success";
        $_SESSION['message'] = 'Item Deleted';
        Helper::redirect('/items');
    }

    public function search()
    {
        $this->permissions(['item:read']);
        $name = $_GET['title'];
        $item = new Item();
        $all_items = $item->get_all();
        $array_name = array();
        foreach ($all_items as $item_title) {
            array_push($array_name, $item_title->title);
        }

        if (in_array($name, $array_name)) {
            $this->view = ('items.single');
            $item_serach = $item->get_by_name($name);
            $date = new \DateTime($item_serach->created_at);
            $item_serach->created_at = $date->format('d/m/Y');
            $this->data['item'] =  $item_serach;
        } elseif ($name == "") {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'You must input the title name';
            Helper::redirect('/items');
            die;
        } else {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'Item not Found';
            Helper::redirect('/items');
            die;
        }
    }
}
