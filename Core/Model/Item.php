<?php

namespace Core\Model;

use Core\Base\Model;

class Item extends Model
{
    public function get_top_5(): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM items ORDER BY price DESC LIMIT 5");
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



    public function get_by_name($name)
    {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE title=?");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_object();
    }
}
