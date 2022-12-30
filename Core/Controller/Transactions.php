<?php

namespace Core\Controller;

use Core\Helpers\Helper;
use Core\Base\Controller;
use Core\Model\Item;
use Core\Model\Transaction;


class Transactions extends Controller
{
    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }

    function __construct()
    {
        $this->permissions(['seller:read']);
        $this->auth();
        $this->admin_view(true);
    }


    public function view_ajax()
    {
        $this->view = 'transactions.index';
    }

    /**
     * Undocumented function
     *
     * @return void
     *! edit the transacion by id get from reauest in url 
     */
    public function transaction_edit()
    {
        $this->view = 'transactions.edit';
        $transaction = new Transaction();
        $selected_transaction = $transaction->get_by_id($_GET['id']);
        $date = new \DateTime($selected_transaction->updated_at);
        $selected_transaction->updated_at = $date->format('m/d/Y');
        $this->data['transaction'] = $selected_transaction;
    }


    /**
     * Undocumented function
     *
     * @return void
     *! edit the transacion by id get from reauest in url 
     */
    public function transaction_update()
    {

     
            $transaction = new Transaction();
            $selected_transaction = $transaction->get_by_id($_POST['id']);

            $item = new Item();
            $selected_item = $item->get_by_id($_POST['item_id']);

            $id_transaction = $_POST['id'];
            $id_item = $_POST['item_id'];
            $post_quantity = $_POST['quantity'];
            $quantity_transaction = $selected_transaction->quantity;
            $quantity_item = $selected_item->quantity;

            $result_quantity = 0;
            $item_final = 0;

            $price_total = $selected_item->price * $post_quantity;

            if ($quantity_item != 0) {

                if ($post_quantity > $quantity_transaction) {
                    // 2 - 3  = // Item Qauntity +

                    $result_quantity = $post_quantity - $quantity_transaction;
                    $item_final = $quantity_item - $result_quantity;
                }
            } else {
                $_SESSION['message'] = "The Item is Empty";
                $_SESSION['error_type'] = "error";
                Helper::redirect('/transactions/page');
            }


            //! Check if the post quantity more than quantity current in table item 
            //* $quantity_transaction The current quantity in transaction table
            //* $quantity_item The current quantity in item table
            //* $post_quantity The Post updated quantity item
            //* $result_differance_quantity = $post_quantity - $quantity transcation
            //! if result_deffirance_quantity > $quantity_item => error The $post_quantity more than item in database

            $result_differance_quantity = $post_quantity - $quantity_transaction;
            if ($result_differance_quantity > $quantity_item) {
                $_SESSION['message'] = "items is not enough";
                $_SESSION['error_type'] = "warning";
                Helper::redirect('/transactions/page');
                die;
            }

            if ($post_quantity == "") {
                $_SESSION['message'] = "The Transaction is updated";
                $_SESSION['error_type'] = "success";
                Helper::redirect('/transactions/page');
                die;
            }

            if ($post_quantity < $quantity_transaction) {
                // 2 - 3  = // Item Qauntity +

                $result_quantity = $quantity_transaction - $post_quantity;
                $item_final = $result_quantity + $quantity_item;
            }


            // $sql_item = "UPDATE items SET quantity = $item_final WHERE id = $id_item";
            // $item->connection->query($sql_item);
            $stmt = $item->connection->prepare("UPDATE items SET quantity = ? WHERE id =?");
            $stmt->bind_param('ii', $item_final, $id_item);
            $stmt->execute();
            $stmt->close();

            $sql_transaction = "UPDATE transactions SET quantity = $post_quantity,total = $price_total WHERE id = $id_transaction";
            $transaction->connection->query($sql_transaction);
            $_SESSION['message'] = "The Transaction is updated";
            $_SESSION['error_type'] = "success";
            Helper::redirect('/transactions/page');

    }
}
