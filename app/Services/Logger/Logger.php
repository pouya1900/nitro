<?php

namespace App\Services\Logger;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;
use Carbon\Carbon;

/**
 * Class Logger
 * @package App\Services
 */
class Logger
{
    /**
     * @var string
     */
    private $event;
    /**
     * @var
     */
    private $logger;
    /**
     * @var
     */
    private $path;
    /**
     * @var string
     */
    private $publicLogDir;

    /**
     * Logger constructor.
     *
     * @param $logger
     * @param string $event
     */
    function __construct($event = 'log')
    {
        $this->logger = new MonologLogger('log');
        $this->event = $event;
        // define main logs folder path
        $this->publicLogDir = env('logStoragePath', storage_path('logs'));
        // create essential directories if they are not created before
        $this->createDirectories();
        // create new stream handler
        $handler = new StreamHandler($this->path);
        // create a new formatter to ignore empty brackets [][]
        // $"[%datetime%][%channel%][%level_name%] : %message% %context% \n"
        $seperateOperator = "**************************************** " . Carbon::now() . " ****************************************";
        $formatter = new LineFormatter("$seperateOperator\ntime: [%datetime%] \n%message% %context% \n", 'H:i:s', true, true);
        // set formatter to handler
        $handler->setFormatter($formatter);
        // push handler into logger
        $this->logger->pushHandler($handler);
    }

    /**
     * create a debug log in path
     *
     * @param $text define log message
     */
    public function log($text)
    {
        try {
            $this->logger->debug($text);
        } catch (\Exception $e) {
            \Log::error($text);
            \Log::error($e);
        }
    }

    /**
     * create directories by date type
     *
     * @return bool
     */
    private function createDirectories()
    {
        // path will be like: 2016/01/01
        $logDir = $this->publicLogDir . '/' . $this->event . '/' . date('Y') . '/' . date('m');
        $this->createDirectory($logDir);
        $this->path = $logDir . '/' . date('d') . '.log';
        return true;
    }

    /**
     * create a path(directories) by path address
     *
     * @param $path
     *
     * @return bool
     */
    private function createDirectory($path)
    {
        if (file_exists($path)) {
            return false;
        }

        mkdir($path, 0777, true);
        return true;
    }


}

