<?php

namespace Vegacms\Cms\Http\Controllers\Auth;

use Vegacms\Cms\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Vegacms\Cms\Services\Interfaces\GroupServiceInterface;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @param void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('vegacms::auth.login');
    }

    public function redirectTo()
    {
        $groupService = resolve(GroupServiceInterface::class);
        $user = auth()->user();

        if($groupService->userHasGroup($user, 'admins') || $groupService->userHasGroup($user, 'moderators')) {
            return route('admin-dashboards.index');
        }

        return route('home');
    }
}
