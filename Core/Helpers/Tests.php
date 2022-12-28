<?php

namespace Core\Helpers;

use Exception;

trait Tests
{
    protected static function check_if_exists($expr, $msg)
    {
        try {
            if (!$expr) {
                throw new \Exception($msg);
            }
        } catch (\Exception $error) {
            echo $error->getMessage();
            die;
        }
    }

    protected static function check_empty(): bool
    {
        $errors = array();

        if (empty($_POST['title'])) {
            $errors['title'] = 'The title is required';
        }
        if (empty($_POST['cost'])) {
            $errors['cost'] = 'The cost is required';
        }
        if (empty($_POST['price'])) {
            $errors['price'] = 'The price is required';
        }
        if (empty($_POST['quantity'])) {
            $errors['quantity'] = 'The quantity is required';
        }
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            Helper::redirect('/items/create');
            exit;
        } else {
            unset($_SESSION['errors']);
            return true;
        }
    }


    protected static function check_empty_user(): bool
    {
        $errors = array();

        if (empty($_POST['password'])) {
            $errors['password'] = 'The password is required';
        }
        if (empty($_POST['username'])) {
            $errors['username'] = 'The username is required';
        }
        if (empty($_POST['display_name'])) {
            $errors['display_name'] = 'The display name is required';
        }

        if (empty($_POST['email'])) {
            $errors['email'] = 'The email is required';
        }
        if (strlen($_POST['username'] >= 5)) {
            $errors['user_leng'] = 'username Must be More than 5 Characters';
        }
        if (strlen($_POST['display_name'] >= 5)) {
            $errors['display_leng'] = 'display Name Must be More than 5 Characters';
        }
        // if (strlen($_POST['password'] >= 7)) {
        //     $errors['pass_leng'] = 'Password Must be More than 7 Characters';
        // }

        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            Helper::redirect('/users/create');
            exit;
        } else {
            unset($_SESSION['errors']);
            return true;
        }
    }


    protected static function check_if_empty($var)
    {
        try {
            if (empty($var)) {
                throw new \Exception("Empty data");
            }
        } catch (\Exception $error) {
            echo $error->getMessage();
            die;
        }
    }
}
