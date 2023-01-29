<?php

namespace Core;

use Core\Base\View;

/**
 * Manages the routing process in the application
 */
class Router
{
    // Requests types
    // GET requests
    protected static $get_routes = array();
    // POST requests
    protected static $post_routes = array();
    // PUT requests
    protected static $put_routes = array();
    // DELETE requests
    protected static $delete_routes = array();

    public static function redirect(): void
    {

        $request = $_SERVER['REQUEST_URI'];
        // [0] /posts/edit
        $request = \explode("?", $request)[0];
        $routes = array();

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $routes = self::$get_routes;
                break;
            case 'POST':
                $routes = self::$post_routes;
                break;
        }
        //request => routes[request]
        //users => users.index
        if (empty($routes) || !array_key_exists($request, $routes)) {
            http_response_code(404);
            new View('404');
            exit;
        }

        $controller_namespace = 'Core\\Controller\\';
        $class_arr = explode('.', $routes[$request]);
        $class_name = ucfirst($class_arr[0]);
        $class = $controller_namespace . $class_name;

        $instence = new $class;
        if (count($class_arr) == 2) {
            //posts.edit
            call_user_func([$instence, $class_arr[1]]);
        }

        $instence->render();
    }

    public static function get($route, $controller): void
    {
        self::$get_routes[$route] = $controller;
    }

    public static function post($route, $controller): void
    {
        self::$post_routes[$route] = $controller;
    }
}
