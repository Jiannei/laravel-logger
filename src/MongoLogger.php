<?php


namespace Jiannei\Logger\Laravel;

use Carbon\Carbon;
use MongoDB\Client;
use Monolog\Handler\MongoDBHandler;
use Monolog\Logger;

class MongoLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     *
     * @return Logger
     */
    public function __invoke(array $config)
    {
        $uri = "mongodb://{$config['host']}:{$config['port']}";
        switch ($config['separate']) {
            case 'daily':
                $collection = Carbon::now()->format('Ymd').'_log';
                break;
            case 'monthly':
                $collection = Carbon::now()->format('Ym').'_log';
                break;
            case 'yearly':
                $collection = Carbon::now()->format('Y').'_log';
                break;
            default:
                $collection = 'logs';
        }

        $handler = new MongoDBHandler( // 创建 Handler
            new Client($uri), // 创建 MongoDB 客户端（依赖 mongodb/mongodb）
            $config['database'],
            $collection
        );
        $handler->setLevel($config['level']);

        $logger = new Logger($config['channel']); // 创建 Logger
        $logger->pushHandler($handler); // 挂载 Handler

        return $logger;
    }
}