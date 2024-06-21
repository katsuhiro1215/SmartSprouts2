<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventStoreRequest;
use App\Http\Requests\UpdateEventStoreRequest;
use App\Models\EventStore;

class EventStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventStoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EventStore $eventStore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventStore $eventStore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventStoreRequest $request, EventStore $eventStore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventStore $eventStore)
    {
        //
    }
}
