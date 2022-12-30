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
        $this->data['item'] = $item->get_by_id($_GET['id']);
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

            echo 'title_not_found';
        }

        if (empty($_POST['cost'])) {
            echo 'cost_not_found';
        }

        if (empty($_POST['price'])) {
            echo 'price_not_found';
        }
        if (empty($_POST['quantity'])) {
            echo 'quantity_not_found';
        }

        $item = new Item();
        $_POST['user_id'] = $_SESSION['user']['user_id'];
        $_POST['title'] =  \htmlspecialchars($_POST['title']);
        $_POST['cost'] =  \htmlspecialchars($_POST['cost']);
        $_POST['price'] =  \htmlspecialchars($_POST['price']);
        $_POST['quantity'] =  \htmlspecialchars($_POST['quantity']);

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
        $selected_item = $item->get_by_id($_GET['id']);;
        $this->data['item'] = $selected_item;
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
}
