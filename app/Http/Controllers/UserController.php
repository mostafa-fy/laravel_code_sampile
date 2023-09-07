<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index(): View
    {
        $users= UserService::getUser();
        $permissions = Permission::all();
        return view('partials.user',compact('users','permissions'));
    }

    public  function store(UserRequest $request): RedirectResponse 
    {
        UserService::store($request->validated());
        return back()->with('success','User Crerated');
    }


}
