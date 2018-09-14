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
        $GLOBALS['config'] = include CONFIG_PATH . "routes.php";

        // Define platform, controller, action, for example:
        if (array_key_exists($_SERVER['REQUEST_URI'], $GLOBALS['config']['routes'])) {

            var_dump($_REQUEST); die;

//            if ($GLOBALS['config']['routes'][$_SERVER['REQUEST_URI']]['request_method'] !== $_SERVER['REQUEST_METHOD']) {
//                throw new FrameworkException("resource doesn\'t accept {$_SERVER['REQUEST_METHOD']}");
//            }

            $controllerName = $GLOBALS['config']['routes'][$_SERVER['REQUEST_URI']]['controller'];
            $methodName = $GLOBALS['config']['routes'][$_SERVER['REQUEST_URI']]['method'];
        }

        define("CONTROLLER", isset($controllerName) ? $controllerName : 'Home');
        define("METHOD", isset($methodName) ? $methodName : 'index');

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
            $controller->$methodName();

        } catch (\Throwable $throwable) {
            var_dump($throwable);
            die();
        } catch (\Error $error) {
            // Dispatch Error Controller
            var_dump($error);
            die();
        }
    }
}

class FrameworkException extends \Exception
{

}