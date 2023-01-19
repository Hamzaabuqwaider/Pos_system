<?php


namespace Core\Model;

use Core\Base\Model;

class Contact extends Model
{
    public function get_contacts_by_id($user_id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM contacts WHERE user_id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }
}
