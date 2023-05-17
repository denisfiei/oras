<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConvertStringNullToNull
{
    protected static $skipCallbacks = [];

    public function handle(Request $request, Closure $next)
    {
        foreach (static::$skipCallbacks as $callback) {
            if ($callback($request)) {
                return $next($request);
            }
        }

        return $next($request);
    }

    protected function transform($key, $value)
    {
        return is_string($value) && $value === 'null' ? null : $value;
    }
}
