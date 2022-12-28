<?php

namespace Core\Controller;

use Core\Model\Item;
use Core\Model\User;
use Core\Helpers\Tests;
use Core\Model\Account;
use Core\Helpers\Helper;
use Core\Base\Controller;
use Core\Model\Transaction;

class Accounts extends Controller
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
         *! Page accounts
         *! @return array 
         *!function index
         *!the function is get all of transactions and total of sales in transaction table
         */
        public function index()
        {
                $this->permissions(['account:read']);
                $this->view = 'accounts.index';
                $transaction = new Account;
                $transaction_total_price = new Transaction;
                $result = $transaction_total_price->get_all();
                $price = 0;
                foreach ($result as $res) {
                        $price += $res->total;
                }
                $this->data['transactions'] = $transaction->get_transactions();
                $this->data['total_price'] = $price;
        }

        /**
         *! @return array of data 
         *! and return view page 
         * !Edit the data transaction in page
         */

        public function edit()
        {
                $this->permissions(['account:read', 'account:update']);
                $this->view = "accounts.edit";
                $transaction = new Transaction();
                $selected_transaction = $transaction->get_by_id($_GET['id']);
                $this->data['transaction'] = $selected_transaction;
        }


        /**
         * Undocumented function
         *
         * @return void
         *! the function update the Transaction quantity after bougth 
         *  
         */
        public function update()
        {
                $this->permissions(['account:read', 'account:update']);

                try {
                        //! The function get transaction by id => $_POST[id]
                        $transaction = new Transaction();
                        $selected_transaction = $transaction->get_by_id($_POST['id']);

                        //! The function get item by id => $_POST[id]
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

                        //! check if the quantity item selected is empty before update the quantity in the Account page
                        if ($quantity_item != 0) {
                                if ($post_quantity > $quantity_transaction) {
                                        // 2 - 3  = // Item Qauntity +

                                        $result_quantity = $post_quantity - $quantity_transaction;
                                        $item_final = $quantity_item - $result_quantity;
                                }
                        } else {
                                $_SESSION['message'] = "The Item is Empty";
                                $_SESSION['error_type'] = "error";
                                Helper::redirect('/accounts/page');
                        }


                        //! Check if the post quantity more than quantity current in table item 
                        //* $quantity_transaction The current quantity in transaction table
                        //* $quantity_item The current quantity in item table
                        //* $post_quantity The Post updated quantity item
                        //* $result_differance_quantity = $post_quantity - $quantity transcation
                        //! if result_deffirance_quantity > $quantity_item => error The $post_quantity more than item in database


                        //* check the quantitu in table item < defferance_quantity 
                        $result_differance_quantity = $post_quantity - $quantity_transaction;
                        if ($result_differance_quantity > $quantity_item) {
                                $_SESSION['message'] = "item quantity in stock not enogh";
                                $_SESSION['error_type'] = "warning";
                                Helper::redirect('/accounts/page');
                                die;
                        }

                        if ($post_quantity == "") {
                                $_SESSION['message'] = "The Transaction is updated";
                                $_SESSION['error_type'] = "success";
                                Helper::redirect('/accounts/page');
                                die;
                        }

                        if ($post_quantity < $quantity_transaction) {
                                // 2 - 3  = // Item Qauntity +

                                $result_quantity = $quantity_transaction - $post_quantity;
                                $item_final = $result_quantity + $quantity_item;
                        }

                        //! update the quantity in the table items after updated from the account page
                        $stmt = $item->connection->prepare("UPDATE items SET quantity = ? WHERE id = ?");
                        $stmt->bind_param('ii', $item_final, $id_item);
                        $stmt->execute();
                        $stmt->close();

                        // $sql_item = "UPDATE items SET quantity = $item_final WHERE id = $id_item";
                        // $item->connection->query($sql_item);

                        $stmt1 = $transaction->connection->prepare("UPDATE transactions SET quantity = ?,total = ? WHERE id = ?");
                        $stmt1->bind_param('iii', $post_quantity, $price_total, $id_transaction);
                        $stmt1->execute();
                        $stmt1->close();

                        // $sql_transaction = "UPDATE transactions SET quantity = $post_quantity,total = $price_total WHERE id = $id_transaction";
                        // $transaction->connection->query($sql_transaction);
                        $_SESSION['message'] = "The Transaction is updated";
                        $_SESSION['error_type'] = "success";
                        Helper::redirect('/accounts/page');
                } catch (\Exception $error) {
                        $this->response_schema['success'] = false;
                        $this->response_schema['message_code'] = $error->getMessage();
                }
        }

        /**
         * Undocumented function
         * @return void
         *! delete the transaction from table transaction and retreve the quantity item in the table item befor delete 
         */
        public function delete()
        {
                $this->permissions(['account:delete']);

                $item = new Item();
                $item_id = $_GET['item_id'];
                $item_select = $item->get_by_id($item_id);
                $quantity_current = $item_select->quantity;
                $transaction = new Transaction();
                $transaction_select = $transaction->get_by_id($_GET['id']);
                $transaction_quantity = $transaction_select->quantity;
                $result = $quantity_current + $transaction_quantity;


                $stmt = $item->connection->prepare("UPDATE items SET quantity = ? WHERE id =?");
                $stmt->bind_param('ii', $result, $item_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();

                // $sql = "UPDATE items SET quantity = $result WHERE id =$item_id";
                // $item->connection->query($sql);


                $transaction->delete($_GET['id']);

                $_SESSION['error_type'] = "success";
                $_SESSION['message'] = 'Transaction Deleted';

                Helper::redirect('/accounts/page');
        }
}
