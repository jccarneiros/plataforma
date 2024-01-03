<?php
declare(strict_types=1);

namespace Modules\Administrators\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * AdministratorRouteMiddleware
 */
class AdministratorRouteMiddleware
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->super_admin == 1) {
            return $next($request);
        }

        abort(403, 'Ação não autorizada.');
        /* return response()->view('errors.check-permission'); */
    }

}