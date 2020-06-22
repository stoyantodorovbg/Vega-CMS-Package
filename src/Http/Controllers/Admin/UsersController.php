<?php

namespace Vegacms\Cms\Http\Controllers\Admin;

use Vegacms\Cms\Models\User;
use Vegacms\Cms\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Vegacms\Cms\Http\Requests\Admin\AdminUserRequest;

class UsersController extends Controller
{
    /**
     * Admin users index page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('vegacms::admin.users.index');
    }

    /**
     * Admin users show page
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('vegacms::admin.users.show', compact('user'));
    }

    /**
     * Admin users create page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('vegacms::admin.users.create');
    }

    /**
     * Admin users store action
     *
     * @param AdminUserRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(AdminUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin-users.edit', compact('user'));
    }

    /**
     * Admin users edit page
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('vegacms::admin.users.edit', compact('user'));
    }

    /**
     * Admin users update action
     *
     * @param User $user
     * @param AdminUserRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(User $user, AdminUserRequest $request)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with(compact('user'));
    }
}
