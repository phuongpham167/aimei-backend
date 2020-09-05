<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // The constant we used when want to take all items such as: Cancel Reasons, Side Effect Categories
    const ALL_ITEMS = 500;

    protected $defaultLimit = 20;

    protected $maximumLimit = 50;

    protected function getLimit(Request $request, $name = 'limit', $default = null, $maximum = null)
    {
        $default = (int) $default ?: $this->defaultLimit;

        $maximum = (int) $maximum ?: $this->maximumLimit;

        $limit = $request->get($name, $default);

        return min($limit, $maximum);
    }

    protected function setAuthenticatedUser(User $user, $guard = null)
    {
        $auth = $this->getAuthManager();
        // Set logged-in user for current request.
        $auth->guard($guard)->setUser($user);
        $auth->shouldUse($guard);
    }

    protected function getAuthManager()
    {
        return app(AuthManager::class);
    }
}
