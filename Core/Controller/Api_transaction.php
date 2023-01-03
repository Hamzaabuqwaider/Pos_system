<?php

namespace Core\Controller;

use Exception;
use Core\Model\Item;
use Core\Helpers\Tests;
use Core\Base\Controller;
use Core\Model\Transaction;
use Core\Controller\Transactions;
use Core\Helpers\Helper;

class Api_transaction extends Controller
{
    use Tests;
    protected $request_body;
    protected $http_code = 200;

    protected $response_schema = array(
        "success" => true, // to provide the response status.
        "message_code" => "", // to provide message code for the front-end developer for a better error handling
        "body" => []
    );

    function __construct()
    {
        $this->auth();
        $this->admin_view(true);
        $this->request_body = (array) json_decode(file_get_contents("php://input"));
    }

    public function render()
    {

        header("Content-Type: application/json"); // changes the header information
        http_response_code($this->http_code); // set the HTTP Code for the response
        echo json_encode($this->response_schema); // convert the data to json format
    }

    /**
     * Undocumented function
     *
     * @return array
     * ! return all of items in the api_view_ajax and show in the select element
     */
    public function items()
    {
        $this->permissions(['seller:read']);

        try {
            $item = new Item;
            $items = $item->get_all();
            if (empty($items)) {
                throw new \Exception('No items were found!');
            }
            $this->response_schema['body'] = $items;
            $this->response_schema['message_code'] = "items_collected_successfuly";
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = 404;
        }
    }


    /**
     *
     * @return array
     *! return all of the transaction create in the date now 
     *! then show in the table of end the page 
     */
    public function index()
    {
        $this->permissions(['seller:read']);

        $transaction = new Transaction;
        $transactions = $transaction->get_today_transaction($_SESSION['user']['user_id']);


        try {
            if (empty($transactions)) {
                throw new \Exception('No Transactions found Today!');
            }
            $this->response_schema['body'] = $transactions;

            $this->response_schema['message_code'] = "transactions_collected_successfuly";
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = 404;
        }
    }

    /**
     * Undocumented function
     *
     * @return array
     *! return the items by id and get the quantity and price from this item  
     */
    function items_by_id()
    {
        try {
            self::check_if_empty($this->request_body);
            $item = new Item;
            $item = $item->get_by_id($this->request_body['id']);
            if (empty($item)) {
                throw new \Exception('No items were found!');
            }


            $this->response_schema['body'] = $item;
            $this->response_schema['message_code'] = "item_collected_successfuly";
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = 404;
        }
    }
    /**
     * Undocumented function
     *! the function has create the transaction proccess
     *! Create the transactions from three table 
     *! 1- create the transactions 
     *! 2- updating the required quantity of the item table
     *! 3- insert the user_id has create the transactions and transactions_id in the table relation
     * @return void
     */
    function transaction_create()
    {
        $this->permissions(['seller:create']);
        try {
            if (!isset($this->request_body['quantity'])) {
                $this->http_code = 422;
                throw new \Exception('quantity_param_not_found');
            }

            if (!isset($this->request_body['item_id'])) {
                $this->http_code = 423;
                throw new \Exception('item_id_param_not_found');
            }

            if (!isset($this->request_body['total'])) {
                $this->http_code = 424;
                throw new \Exception('total_param_not_found');
            }


            $transaction_arr = [
                'item_id' => $this->request_body['item_id'],
                'quantity' => $this->request_body['quantity'],
                'total' => $this->request_body['total']
            ];

            $quantity_order = $this->request_body['quantity'];
            $item = new Item();
            $item_result = $item->get_by_id($this->request_body['item_id']);
            if ($item_result->quantity == 0) {
                throw new \Exception('The Item is empty!');
                die;
            } else if ($transaction_arr['quantity'] > $item_result->quantity) {
                $_SESSION['message'] = "The Item in Stock is . $item_result->quantity ";
                $_SESSION['error_type'] = "error";
                die;
            } else {
                $transaction = new Transaction;
                $transaction->create($transaction_arr);

                $transactions = $transaction->get_by_id_title($transaction->connection->insert_id);

                $stmt1 = $transaction->connection->prepare("INSERT INTO users_transactions (transaction_id,user_id) VALUES (?,?)");
                $stmt1->bind_param('ii', $transactions->id, $this->request_body['user_id']);
                $stmt1->execute();
                $stmt1->close();

                $item_current = $item_result->quantity - $quantity_order;

                $stmt = $item->connection->prepare("UPDATE items SET quantity = ? WHERE id =?");
                $stmt->bind_param('ii', $item_current, $item_result->id);
                $stmt->execute();
                $stmt->close();


                $this->response_schema['message_code'] = "Transaction_created_successfuly";
                $this->response_schema['body'][] = $transactions;
            }
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
            $this->http_code = 421;
        }
    }

    /**
     * @return void
     *! delete the transactions and retreve the items quantity in the table item
     */
    public function transaction_delete()
    {

        try {
            if (!isset($this->request_body['id'])) {
                $this->http_code = 422;
                throw new \Exception('id_param_not_found');
            }

            if (!isset($this->request_body['item_id'])) {
                $this->http_code = 423;
                throw new \Exception('item_id_param_not_found');
            }

            if (!isset($this->request_body['quantity'])) {
                $this->http_code = 424;
                throw new \Exception('quantity_param_not_found');
            }

            $this->permissions(['seller:delete']);
            $item = new Item();
            $item_select = $item->get_by_id($this->request_body['item_id']);
            $item_id = $this->request_body['item_id'];
            $this->request_body['quantity'];
            $quantity_reverse = $this->request_body['quantity'];
            $quantity_current = $item_select->quantity;
            $result = $quantity_current + $quantity_reverse;

            $stmt = $item->connection->prepare("UPDATE items SET quantity = ? WHERE id =?");
            $stmt->bind_param('ii', $result, $item_id);
            $stmt->execute();
            $stmt->close();


            $transaction = new Transaction();
            $transaction->delete($this->request_body['id']);
        } catch (\Exception $error) {
            $this->response_schema['success'] = false;
            $this->response_schema['message_code'] = $error->getMessage();
        }
    }
}
