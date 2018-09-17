<?php

namespace Framework\Core;
use DI\ContainerBuilder;
use Dotenv\Dotenv;

class Framework
{
    private static $controllerNamespace = 'Application\\Controllers\\';

    public static function run()
    {
        self::init();
        self::dispatch();
    }

    /**
     * Initialise
     *
     * @throws FrameworkException
     */
    private static function init()
    {
        // Define path constants
        define("DS", DIRECTORY_SEPARATOR);
        define("ROOT", getcwd() . DS);
        define("APP_PATH", ROOT . '../application' . DS);
        define("CONFIG_PATH", APP_PATH . "config" . DS);

        // Load configuration file
        $GLOBALS['functions'] = include CONFIG_PATH . "functions.php";
        $GLOBALS['config'] = include CONFIG_PATH . "routes.php";

        foreach ($GLOBALS['config']['routes'] as $route => $routeDetails) {
            $route = sprintf($route, '([\d]+)');
            $route = str_replace('/', '\/', $route);
            $route = "/^{$route}/";
            preg_match($route, $_REQUEST['url'], $matched);

            if (!empty($matched)) {

                if ($routeDetails['request_method'] !== $_SERVER['REQUEST_METHOD']) {
                    throw new FrameworkException("resource doesn\'t accept {$_SERVER['REQUEST_METHOD']}", 500);
                }

                $controllerName = $routeDetails['controller'];
                $methodName = $routeDetails['method'];
                $id = isset($matched[1]) ? (int) $matched[1] : null;
                break;
            }
        }

        define("CONTROLLER", isset($controllerName) ? $controllerName : 'Home');
        define("METHOD", isset($methodName) ? $methodName : 'index');
        define("ID", $id);

        // Start session
        session_start();
    }

    /**
     * Dispatch controller for a specific URL.
     *
     * @throws \Throwable
     * @throws \Error
     */
    private static function dispatch()
    {
        try {
            $dotenv = new Dotenv(ROOT . '../');
            $dotenv->load();

            // Instantiate the controller class and call its action method
            $controllerName = self::$controllerNamespace . CONTROLLER . "Controller";
            $methodName = METHOD;

            $builder = new ContainerBuilder();
            $container = $builder->build();
            $controller = $container->get($controllerName);
            $controller->$methodName(ID);

        } catch (\Throwable $throwable) {
            throw new FrameworkException($throwable->getMessage(), $throwable->getCode());
        } catch (\Error $error) {
            throw new FrameworkException($error->getMessage(), $error->getCode());
        }
    }
}

class FrameworkException extends \Exception
{
    public function errorMessage()
    {

    }
}
