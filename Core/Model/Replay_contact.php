<?php

namespace Core\Model;

use Core\Base\Model;

class Replay_contact extends Model
{
    public function contact_replay($user_2)
    {
        $stmt = $this->connection->prepare("SELECT * FROM replay_contact WHERE user_2 = ?");
        $stmt->bind_param('i', $user_2);
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
