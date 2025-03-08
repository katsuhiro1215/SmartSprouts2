<?php

namespace App\Http\Controllers\Admin\Person;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserAddressController extends Controller
{
    public function index(User $user)
    {
        return Inertia::render('Admin/Users/UserAddress/Index');
    }

    public function create(User $user)
    {
        return Inertia::render('Admin/Users/UserAddresses/Create', [
            'user' => $user
        ]);
    }

    public function store(Request $request, User $user)
    {
        
    }

    public function edit(User $user, UserAddress $userAddress)
    {
        return Inertia::render('Admin/Users/UserAddresses/Edit', [
            'userAddress' => $userAddress,
            'user' => $user
        ]);
    }

    public function update(Request $request, UserAddress $userAddress, User $user)
    {
        //
    }

    public function destroy(UserAddress $userAddress, User $user)
    {
        //
    }
}
