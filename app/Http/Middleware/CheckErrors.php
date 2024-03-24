<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckErrors
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Kiểm tra nếu có lỗi
        if ($response->status() == 500) {
            // Chuyển hướng đến trang lỗi xử lý
            return redirect()->route('500.errors');
        }

        return $response;
    }
}
