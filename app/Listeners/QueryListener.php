<?php
namespace App\Listeners;
use App\Tools\ToolStr;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;
use DateTime;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
class QueryListener
{

    protected static $sessionId = false;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public static function getCode(){
        $rand   = time() . getmypid() . rand(100000, 999999) . rand(100000, 999999);
        $str    = md5($rand);
        return  strtoupper(substr($str, 0, 8));
    }

    /**
     * 八位大写的随机数字
     *
     */
    public static function getSession(){
        if(self::$sessionId === false){
            self::$sessionId = self::getCode();
        }
        return self::$sessionId;
    }

    /**
     * Handle the event.
     *
     * @param  QueryExecuted $event
     * @return void
     */
    public function handle(QueryExecuted $sql)
    {
        foreach ($sql->bindings as $i => $binding) {
            if ($binding instanceof \DateTime) {
                $sql->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
            } else {
                if (is_string($binding)) {
                    $sql->bindings[$i] = "'$binding'";
                }
            }
        }

        // Insert bindings into query
        $query = str_replace(array('%', '?'), array('%%', '%s'), '['.$sql->connection->getConfig('host').'] '.$sql->sql.' [time:'.$sql->time.']');
        $query = vsprintf($query, $sql->bindings);


        // Save the query to file
        $logFile = fopen(
            storage_path('logs' . DIRECTORY_SEPARATOR . 'query-'.date('Y-m-d') . '.log'), 'a+'
        );
        fwrite($logFile, self::getSession().' ['.date('Y-m-d H:i:s').'] ' . $query . PHP_EOL);

        fclose($logFile);

        //if ('local' === env('APP_ENV', 'production') || 'testing' === env('APP_ENV', 'production')) {
        /*$params = $query->bindings;
        foreach ($params as $index => $param) {
            if ($param instanceof DateTime) {
                $params[$index] = $param->format('Y-m-d H:i:s');
            }
        }
        $sql = str_replace("?", "'%s'", str_replace("%", "'%%'", $query->sql) );
        array_unshift($params, $sql);
        Log::info(call_user_func_array('sprintf', $params));*/
        //}
    }
}