<?php

namespace Routes;

class Router
{

    private $routes = [];

    public function get($url, $callback)
    {
        $this->add('GET', $url, $callback);
    }

    public function post($url, $callback)
    {
        $this->add('POST', $url, $callback);
    }

    public function add($method, $url, $callback)
    {
        $this->routes[] = [
            'method'    => $method,
            'url'       => $url,
            'callback'  => $callback
        ];
    }

    public function make()
    {
        // I used PATH_INFO instead of REQUEST_URI, because the 
        // application may not be in the root direcory
        // and we dont want stuff like ?var=value
        $reqUrl = $_SERVER['PATH_INFO'] ?? '/';
        $reqMet = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $i => $route) {
            // convert urls like '/users/:uid/posts/:pid' to regular expression
            $pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route['url'])) . "$@D";
            $matches = array();
            // check if the current request matches the expression
            if ($reqMet == $route['method'] && preg_match($pattern, $reqUrl, $matches)) {
                // remove the first match
                array_shift($matches);
                // call the callback with the matched positions as params

                [$controller, $method] = $route['callback'];
                $controller = new $controller;

                return call_user_func_array([$controller, $method], $matches);
            } else if ($i == count($this->routes) - 1) {
                // if the request doesnt match any route, show 404
                header('HTTP/1.0 404 Not Found');
                echo '<h1>404 Not Found</h1>';
                exit;
            }
        }
    }
}
