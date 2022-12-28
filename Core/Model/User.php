<?php

namespace Core\Model;

use Core\Base\Model;

class User extends Model
{

    const ADMIN = array(
        "user:read", "user:create", "user:update", "user:delete",
        "item:read", "item:create", "item:update", "item:delete",
        "seller:read", "seller:create", "seller:update", "seller:delete",
        "account:read", "account:create", "account:update", "account:delete",
    );
    const PROCUREMENT = array(
        "item:read", "item:create", "item:update", "item:delete",
    );

    const SELLER = array(
        "seller:read", "seller:create", "seller:update", "seller:delete",
    );

    const ACCOUNT = array(
        "account:read", "account:create", "account:update", "account:delete",
    );

    public function check_username(string $username)
    {
        // $result = $this->connection->query("SELECT * FROM $this->table WHERE username='$username'");
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE username=?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result) {

            if ($result->num_rows > 0) {
                return $result->fetch_object();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_permissions(): array
    {
        $permissions = array();
        $user = $this->get_by_id($_SESSION['user']['user_id']);
        if ($user) {
            // $permissions =/ \explode(',', $user->permissions);
            $permissions = \unserialize($user->permissions);
        }
        return $permissions;
    }
}
