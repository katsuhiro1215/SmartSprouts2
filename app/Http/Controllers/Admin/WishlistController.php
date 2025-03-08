<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WishlistRequest;
use App\Models\Wishlist;
use Inertia\Inertia;

class WishlistController extends Controller
{
    public function index()
    {
        return Inertia::render('Wishlist/Index', [
            'wishlists' => Wishlist::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Wishlist/Create');
    }

    public function store(WishlistRequest $request)
    {
        //
    }

    public function show(Wishlist $wishlist)
    {
        //
    }

    public function edit(Wishlist $wishlist)
    {
        //
    }

    public function update(WishlistRequest $request, Wishlist $wishlist)
    {
        //
    }

    public function destroy(Wishlist $wishlist)
    {
        //
    }
}
