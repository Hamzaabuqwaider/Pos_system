<?php

namespace Core\Model;

use Core\Base\Model;

class Transaction extends Model
{

    public function get_today_transaction($user_id): array
    {
        $data = array();
        $date_now = date("m/d/Y");

        $stmt = $this->connection->prepare("SELECT * FROM users_transactions WHERE user_id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $transaction_id = array();
        foreach ($result as $transaction) {
            $transaction_id[] = $transaction['transaction_id'];
        }



        $data_result = array();
        foreach ($transaction_id as $transaction_select) {

            $stmt = $this->connection->prepare("SELECT transactions.*,items.title as item_name FROM transactions JOIN items ON transactions.item_id = items.id WHERE transactions.id = ?");
            $stmt->bind_param('i', $transaction_select);
            $stmt->execute();
            $result_transaction = $stmt->get_result();
            $stmt->close();

            foreach ($result_transaction as $result_array) {

                $data_result[] = $result_array;
            }
        }

        foreach ($data_result as $result_data) {
            $date = new \DateTime($result_data['created_at']);
            $result_data['created_at'] = $date->format('m/d/Y');

            if ($date_now == $result_data['created_at']) {
                $data[] = $result_data;
            }
        }
        return $data;
    }


    public function get_by_id_title($id)
    {
        $stmt = $this->connection->prepare("SELECT transactions.*,items.title as title_name,items.img as img_item FROM transactions JOIN items ON transactions.item_id=items.id WHERE transactions.id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_object();
    }
}
