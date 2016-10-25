<?php

namespace Liker\Support\Database;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class SqlLoggingServiceProvider
 *
 * Logging SQL queries
 *
 * @package Contact\Support\Database
 */
class SqlLoggingServiceProvider extends ServiceProvider
{
    /**
     * Register the application services
     * @return void
     */
    public function register()
    {
        //Register service only log sql enable
        if (env('APP_LOG_SQL', false)) {
            $this->listenQuery(); //service sql listen
        }
    }

    /**
     * Listen Query SQL
     * @return void
     */
    private function listenQuery()
    {
        app('db')->listen(function($query) {

            $sql = $query->sql;
            $time = $query->time;
            $bindings = $query->bindings;

            $data = compact('bindings', 'time');

            // Format binding data for sql insertion
            foreach ($bindings as $i => $binding) {
                if ($binding instanceof \DateTime) {
                    $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                } else if (is_string($binding)) {
                    $bindings[$i] = "'$binding'";
                }
            }

            // Insert bindings into query
            $sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);
            $sql = vsprintf($sql, $bindings);

            $log = new Logger('sql');
            $log->pushHandler(new StreamHandler(storage_path() . '/logs/laravel-' . date('Y-m-d') . '.log', Logger::INFO));

            $data['request_data'] = Request::all();
            $data['request_path'] = Request::path();
            $data['request_method'] = Request::method();

            // add records to the log
            $log->addInfo($sql, $data);
        });
    }
}