<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_as', 'user')->with(['client'])->latest()->get();

        return view('admin.account.user.index', compact('users'));
    }

}
