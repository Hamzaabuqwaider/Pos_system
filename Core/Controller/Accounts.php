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
                $date = new \DateTime($selected_transaction->updated_at);
                $selected_transaction->updated_at = $date->format('m/d/Y');
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

                $transaction = new Transaction();
                $transaction_by_id = $transaction->get_by_id($_POST['id']);

                $item = new Item();
                $item_by_id = $item->get_by_id($_POST['item_id']);

                $id_transaction = $_POST['id'];
                $id_item = $_POST['item_id'];
                $request_quantity = $_POST['quantity'];
                $quantity_transaction_current = $transaction_by_id->quantity;
                $quantity_item_current = $item_by_id->quantity;

                $result_quantity = 0;
                $item_final = 0;

                if ($request_quantity == "") {
                        $_SESSION['message'] = "The Transaction is updated";
                        $_SESSION['error_type'] = "success";
                        Helper::redirect('/accounts/page');
                        die;
                }

                $price_total = $item_by_id->price * $request_quantity;

                if ($quantity_item_current != 0) {

                        if ($request_quantity > $quantity_transaction_current) {
                                // 2 - 3  = // Item Qauntity +

                                $result_quantity = $request_quantity - $quantity_transaction_current;
                                $item_final = $quantity_item_current - $result_quantity;
                        }
                } else {
                        $_SESSION['message'] = "The Item is Empty";
                        $_SESSION['error_type'] = "error";
                        Helper::redirect('/accounts/page');
                }

                $result_differance_quantity = $request_quantity - $quantity_transaction_current;
                if ($result_differance_quantity > $quantity_item_current) {
                        $_SESSION['message'] = "item quantity in stock not enogh";
                        $_SESSION['error_type'] = "error";
                        Helper::redirect('/accounts/page');
                        die;
                }



                if ($request_quantity < $quantity_transaction_current) {
                        // 2 - 3  = // Item Qauntity +

                        $result_quantity = $quantity_transaction_current - $request_quantity;
                        $item_final = $result_quantity + $quantity_item_current;
                }

                $stmt = $item->connection->prepare("UPDATE items SET quantity = ? WHERE id = ?");
                $stmt->bind_param('ii', $item_final, $id_item);
                $stmt->execute();
                $stmt->close();

                $stmt = $transaction->connection->prepare("UPDATE transactions SET quantity = ?,total = ? WHERE id = ?");
                $stmt->bind_param('iii', $request_quantity, $price_total, $id_transaction);
                $stmt->execute();
                $stmt->close();
                $_SESSION['message'] = "The Transaction is updated";
                $_SESSION['error_type'] = "success";
                Helper::redirect('/accounts/page');
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

                $transaction->delete($_GET['id']);

                $_SESSION['error_type'] = "success";
                $_SESSION['message'] = 'Transaction Deleted';

                Helper::redirect('/accounts/page');
        }
}
