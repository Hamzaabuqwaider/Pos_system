<?php

namespace Core\Controller;

use Core\Model\User;
use Core\Helpers\Helper;
use Core\Base\Controller;
// use Core\Model\Post;
use Core\Model\Item;
use Core\Model\Transaction;

class Admin extends Controller
{
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
     * Undocumented function
     * @return array of data
     *! return the all of items from table items
     *! return the all of transactions from table transactions
     *! return the top of items salles from table transactions
     *! return the all of items quantity from table items
     *! return the all of users from table users
     */
    public function index()
    {
        $this->view = 'dashboard';
        $total = 0;
        $user = new User; // new model user.
        $item = new Item; // new model user.
        $transaction = new Transaction();
        $get_all_sales = $transaction->get_all();
        foreach ($get_all_sales as $sales) {
            $total = $total + $sales->total;
        }

        $get_total_quantity = $item->get_all();
        $total_quantity = 0;
        foreach ($get_total_quantity as $quantity) {
            $total_quantity += $quantity->quantity;
        }
        $transaction = new Transaction; // new model user.

        $stmt1 = $transaction->connection->prepare("SELECT *,items.cost,items.price,transactions.quantity as quantity_trans FROM `transactions` INNER JOIN items on items.id = transactions.item_id");
        $stmt1->execute();
        $result = $stmt1->get_result();
        $profit = 0;
        foreach ($result as $res) {
            $result_trans = $res['quantity_trans'] * ($res['price'] - $res['cost']);
            $profit += $result_trans;
        }


        $stmt1->close();



        $this->data['user_info'] = $user->get_by_id($_SESSION['user']['user_id']);
        $this->data['users_count'] = count($user->get_all());
        $this->data['items_count_all'] = count($item->get_all());
        $this->data['transaction_count'] = count($transaction->get_all());
        $this->data['total_sales'] = $total;
        $this->data['profit'] = $profit;


        $this->data['items'] = $item->get_top_5();
        $this->data['items_count'] = count($item->get_top_5());
        $this->data['total_quantity'] = $total_quantity;
    }
}
