<?php

namespace AliasProject\Log;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;

class Log
{
    protected static $instance;

    /**
     * Method to return the Monolog instance
     *
     * @return \Monolog\Logger
     */
    static public function getLogger()
    {
        if (!self::$instance) {
            self::configureInstance();
        }
        return self::$instance;
    }

    /**
     * Configure Monolog to use a rotating files system.
     *
     * @return Logger
     */
    protected static function configureInstance()
    {
        $dir = dirname(__DIR__, 4) . '/storage/logs';

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $logger = new Logger('local');
        $stream = new RotatingFileHandler($dir . DIRECTORY_SEPARATOR . 'main.log', 7);
        $stream->setFormatter(new LineFormatter(null, 'Y-m-d H:i:s', true, true));
        $logger->pushHandler($stream);

        self::$instance = $logger;
    }

    public static function debug($message, array $context = [])
    {
        self::getLogger()->debug($message, $context);
    }

    public static function info($message, array $context = [])
    {
        self::getLogger()->info($message, $context);
    }

    public static function notice($message, array $context = [])
    {
        self::getLogger()->notice($message, $context);
    }

    public static function warning($message, array $context = [])
    {
        self::getLogger()->warning($message, $context);
    }

    public static function error($message, array $context = [])
    {
        self::getLogger()->error($message, $context);
    }

    public static function critical($message, array $context = [])
    {
        self::getLogger()->critical($message, $context);
    }

    public static function alert($message, array $context = [])
    {
        self::getLogger()->alert($message, $context);
    }

    public static function emergency($message, array $context = [])
    {
        self::getLogger()->emergency($message, $context);
    }
}
