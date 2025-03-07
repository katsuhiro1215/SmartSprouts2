<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreditTransactionRequest;
use App\Http\Requests\UpdateCreditTransactionRequest;
use App\Models\CreditTransaction;

class CreditTransactionController extends Controller
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
    public function store(StoreCreditTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CreditTransaction $creditTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CreditTransaction $creditTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCreditTransactionRequest $request, CreditTransaction $creditTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CreditTransaction $creditTransaction)
    {
        //
    }
}
