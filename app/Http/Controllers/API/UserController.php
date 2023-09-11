<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResourceCollection;

class UserController extends Controller
{
    public function index(request $request)
    {
        try {
            $this->authorize('viewAny', User::class);
            return  new UserResourceCollection(User::when($request->hasHeader('withRoles') && $request->hasHeader('withPosts'), function ($query) {
                $query->with(['roles', 'posts']);
            })->when($request->hasHeader('withPosts'), function ($query) {
                $query->with(['posts']);
            })->when($request->hasHeader('withRoles'), function ($query) {
                $query->with(['roles']);
            })->exceptadmin()->get());
        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Get the authenticated User.
     */
    public function profile()
    {
        try {

            return new UserResource(Auth::user());
        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()],500);
        }
    }
}
