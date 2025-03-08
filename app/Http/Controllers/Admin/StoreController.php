<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index()
    {
        $data = ['id', 'name', 'type', 'address1', 'address2', 'address3', 'address4', 'phone_number', 'email', 'status'];

        return Inertia::render('Admin/Stores/Index', [
            'allStores' => StoreResource::collection(Store::select($data)->get()),
            'stores' => StoreResource::collection(Store::withoutTrashed()->select($data)->get()),
            'deletedStores' => StoreResource::collection(Store::onlyTrashed()->select($data)->get()),
            'userRole' => Auth::user()->role
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Stores/Create');
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        $zipcode = $request->zipcode;
        if (strpos($zipcode, '-') === false) {
            $validatedData['zipcode'] = substr_replace($zipcode, '-', 3, 0);
        }
        if ($request->hasFile('store_photo_path')) {
            $validatedData['store_photo_path'] = ImageService::uploadMiddleThumbnail($request->file('store_photo_path'), 'stores');
        }
        if ($request->hasFile('store_logo_path')) {
            $validatedData['store_logo_path'] = ImageService::uploadMiddleThumbnail($request->file('store_logo_path'), 'store_logos');
        }

        try {
            DB::transasaction(function () use ($validatedData) {
                Store::create($validatedData);
            });

            return to_route('admin.store.index')->with([
                'message' => '店舗の作成に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.store.create')->with([
                'message' => '店舗の作成に失敗しました。'
            ]);
        }
    }

    public function show(Store $store)
    {
        return Inertia::render('Admin/Stores/Show', [
            'store' => $store,
            'schedules' => $store->schedules,
            'lessons' => $store->lessons()->with('courseCategories')->with('courses')->get(),
            'users' => $store->users()->with('students')->get(),
            'userRole' => Auth::user()->role
        ]);
    }

    public function edit(Store $store)
    {
        return Inertia::render('Admin/Store/Edit', [
            'store' => $store
        ]);
    }

    public function update(StoreRequest $request, Store $store)
    {
        $validatedData = $request->validated();

        try {
            DB::transaction(function () use ($validatedData, $store) {
                $store->update($validatedData);
            });

            return to_route('admin.store.index')->with([
                'message' => '店舗の更新に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.store.edit', $store)->with([
                'message' => '店舗の更新に失敗しました。'
            ]);
        }
    }

    public function destroy(Store $store)
    {
        try {
            DB::transaction(function () use ($store) {
                $store->delete();
            });

            return to_route('admin.store.index')->with([
                'message' => '店舗の削除に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.store.index')->with([
                'message' => '店舗の削除に失敗しました。'
            ]);
        }
    }

    public function restore(Store $store)
    {
        try {
            DB::transaction(function () use ($store) {
                $store->restore();
            });

            return to_route('admin.store.index')->with([
                'message' => '店舗の復元に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.store.index')->with([
                'message' => '店舗の復元に失敗しました。'
            ]);
        }
    }

    public function forceDelete(Store $store)
    {
        try {
            DB::transaction(function () use ($store) {
                $store->forceDelete();
            });

            return to_route('admin.store.index')->with([
                'message' => '店舗の完全削除に成功しました。'
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return to_route('admin.store.index')->with([
                'message' => '店舗の完全削除に失敗しました。'
            ]);
        }
    }
}
