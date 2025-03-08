<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function show(Company $company)
    {
        return Inertia::render('Admin/Company/Show', [
            'company' => $company
        ]);
    }

    public function edit(Company $company)
    {
        return Inertia::render('Admin/Company/Edit', [
            'company' => $company
        ]);
    }

    public function update(CompanyRequest $request, Company $company)
    {
        //
    }

    public function destroy(Company $company)
    {
        //
    }
}
