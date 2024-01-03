<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * AdministrativeRouteMiddleware
 */
class DashboardRouteMiddleware
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->admin == 1) {
            return $next($request);
        }

        abort(403, 'Ação não autorizada.');
        /* return response()->view('errors.check-permission'); */
    }
}
