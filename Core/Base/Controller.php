<?php

namespace Core\Base;

use Core\Base\View;
use Core\Model\User;
use Core\Helpers\Helper;

abstract class Controller
{
    abstract public function render();

    protected $view = null; // posts.edit
    protected $data = array();

    protected function view()
    {
        new View($this->view, $this->data);
    }

    protected function auth()
    {
        if (!isset($_SESSION['user'])) {
            Helper::redirect('/login');
        }
    }

    protected function permissions(array $permissions_set)
    {
        $this->auth();
        // Collect user permissions from the DB
        $user = new User;
        $assigned_permissions = $user->get_permissions();
        // check if the user has all the permissions_set
        foreach ($permissions_set as $permission) {
            if (!in_array($permission, $assigned_permissions)) {
                Helper::redirect('/dashboard');
            }
        }
        // if any of the permission sets are not assigned to the user, redirect to the dashboard
    }


    protected function admin_view(bool $switch): void
    {
        if (isset($_SESSION['user']['is_admin_view'])) {
            $_SESSION['user']['is_admin_view'] = $switch;
        }
    }
}
