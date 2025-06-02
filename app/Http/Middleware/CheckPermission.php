<?php



namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::guard('admin')->user();
        if (!$user || !$user->can($permission)) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
