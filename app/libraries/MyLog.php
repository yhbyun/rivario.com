<?php

class MyLog
{
    const ERROR_IDX = 4;

    protected static $levels = array(
        'debug',
        'info',
        'notice',
        'warning',
        'error',
        'critical',
        'alert',
        'emergency',
    );

    public static function log($level, $message, $context = 'PHP')
    {
        $idx = array_search($level, static::$levels);

        if ($idx >= static::ERROR_IDX) {
            $count = Session::get('error_count', 0);
            Session::put('error_count', ++$count);
            if ($count > 100) {
                return 'logged';
            }
        }

        $data = [
            'context' => $context,
            'user_id' => Auth::check() ? Auth::user()->getKey() : 'guest',
            'url' => Input::get('url', Request::fullUrl()),
            'ip' => Request::getClientIp(),
            //'country' => MyNet::getClientISOCountry(),
            'count' => Session::get('error_count', 0),
            'user_agent' => get_if_set($_SERVER['HTTP_USER_AGENT'], ''),
        ];

        Log::write($level, $message, $data);
    }

    public static function __callStatic($method, $parameters)
    {
        if (in_array($method, static::$levels)) {
            return forward_static_call_array(array('MyLog', 'log'), array_merge(array($method), $parameters));
        }
        throw new \BadMethodCallException("Method [$method] does not exist.");
    }
}
