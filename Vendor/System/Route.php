<?php

namespace System;

class Route
{

    /**
     * Application object
     *
     * @var \System\App
     */
    private $app;

    /**
     * Routes container
     *
     * @var array
     */
    public $routes = [];

    /**
     * not found URL
     *
     * @var string
     */
    private $notFound;

    /**
     * Current route
     *
     * @var string
     */
    private $currentRoute;

    /**
     * Calls container
     *
     * @param \System\App $app
     */
    private $calls = [];

    /**
     * Constructor
     *
     * @param \System\App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
//        pred($this->routes);
    }

    /**
     * Add new route
     *
     * @param string $url
     * @param string $action
     * @param string $requestMethod
     * @return void
     */
    public function add($url, $action, $requestMethod = 'GET')
    {
        $route          = [
            'url'     => $url,
            'pattern' => $this->generatePattern($url),
            'action'  => $this->getAction($action),
            'method'  => strtoupper($requestMethod),
        ];
        $this->routes[] = $route;
    }

    /**
     * Set not found URL
     *
     * @param type $url
     * @return void
     */
    public function notFound($url)
    {
        $this->notFound = $url;
    }

    /**
     * Get all routes
     *
     * @return array
     */
    public function routes()
    {
        return $this->routes;
    }

    /**
     * Call the given callback before calling the main controller
     *
     * @param callable $callable
     * @return $this
     */
    public function callFirst(callable $callable)
    {
        $this->calls['first'][] = $callable;
        return $this;
    }

    /**
     * Determine if there are any callbacks that will be called before calling
     * the main controller
     *
     * @return bool
     */
    public function hasCallsFirst()
    {
        return !empty($this->calls['first']);
    }

    /**
     * Call all callbacks that will be called before calling the main controller
     *
     * @return void
     */
    public function callFirstCalls()
    {
        foreach ($this->calls['first'] as $callback) {
            call_user_func($callback, $this->app);
        }
    }

    /**
     * Get proper route
     *
     * @return array
     */
    public function getProperRoute()
    {
        foreach ($this->routes as $route) {
//            pre($route);
            if ($this->isMatching($route['pattern']) && $this->isMatchingRequestMethod($route['method'])) {
                $arguments          = $this->getArgumentsFrom($route['pattern']);
//                echo '<h1>Matched</h1>';
                // Cotroller@method
                list($controller, $method) = explode('@', $route['action']);
                $this->currentRoute = $route['url'];
                return [$controller, $method, $arguments];
            }
        }
//        die;
        return $this->app->url->redirect($this->notFound);
    }

    /**
     * Determine if the given pattern matches the current request URL
     *
     * @param string $pattern
     * @return bool
     */
    private function isMatching($pattern)
    {
        return preg_match($pattern, $this->app->request->url());
    }

    /**
     * Determine if the current request method matches
     * the given route method
     *
     * @param string $routeMethod
     * @return bool
     */
    private function isMatchingRequestMethod($routeMethod)
    {
        return $routeMethod == $this->app->request->method();
    }

    /**
     * Get Arguments from the current request URL based on the given pattern
     *
     * @param string $pattern
     * @return array
     */
    private function getArgumentsFrom($pattern)
    {
        $matches = [];
        preg_match($pattern, $this->app->request->url(), $matches);
        array_shift($matches);
        return $matches;
    }

    /**
     * Generate a RegEx pattern for the given URL
     *
     * @param string $url
     * @return string
     */
    private function generatePattern($url)
    {
        $pattern = '#^';
        $pattern .= str_replace([':text', ':id'], ['([\w\d+=-\?]+)', '(\d+)'], $url);
        $pattern .= '$#';
        return $pattern;
    }

    /**
     * Get the proper action
     *
     * @param string $action
     * @return string
     */
    private function getAction($action)
    {
        $action = str_replace('/', '\\', $action);
        return strpos($action, '@') !== FALSE ? $action : $action . '@index';
    }

    /**
     * Get current route URL
     *
     * @return string
     */
    public function getCurrentRoute()
    {
        return $this->currentRoute;
    }

}
