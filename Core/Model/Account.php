<?php

namespace Core\Model;

use Core\Base\Model;

class Account extends Model
{
    public function get_transactions()
    {
        $data = array();
        $sql = "SELECT items.title,transactions.item_id as item_id , users.display_name,users.img, transactions.id as transacion_id, transactions.quantity,transactions.created_at,transactions.total, users_transactions.*
        FROM users_transactions
        JOIN transactions ON users_transactions.transaction_id = transactions.id
        JOIN users ON users_transactions.user_id = users.id
        JOIN items ON transactions.item_id = items.id ORDER BY transactions.id DESC";
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {

                $data[] = $row;
            }
        }
        return $data;
    }
}
