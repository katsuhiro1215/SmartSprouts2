<?php

namespace App\Http\Controllers\Admin\Person;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Guardian;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20); // デフォルトは20件
        // 全ユーザー一覧、削除済みユーザー一覧を取得
        $allUsers = User::searchUsers($request->search)->select('id', 'username', 'email')->paginate($perPage);
        $users = User::withoutTrashed()->select('id', 'username', 'email')->paginate($perPage);
        $deletedUsers = User::onlyTrashed()->select('id', 'username', 'email')->paginate($perPage);

        return Inertia::render('Admin/Users/Index', [
            'allUsers' => $allUsers,
            'users' => $users,
            'deletedUsers' => $deletedUsers,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Users/Create', [
            'stores' => Store::select('id', 'name')->get(),
        ]);
    }

    public function store(UserRequest $request)
    {
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return redirect()->back()->with([
                'message' => 'メールアドレスが既に存在しています',
                'status' => 'danger',
            ]);
        }

        // バリデーション済みのデータを取得
        $validated = $request->validated();
        // パスワードをハッシュ化
        $validated['password'] = Hash::make($validated['password']);
        try {
            $user = DB::transaction(function () use ($validated, $request) {
                $user = User::create($validated);
                // 中間テーブルにデータを保存
                $user->stores()->sync($request->input('store_id'));

                return $user;
            });

            return to_route('admin.student.create', ['user' => $user->id])->with([
                'message' => 'ユーザーを登録しました',
                'status' => 'success',
            ]);

        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with([
                'message' => 'ユーザーの登録に失敗しました',
                'status' => 'danger',
            ]);
        }
    }

    public function show(User $user)
    {
        $user = User::with(['userAddresses', 'stores', 'students', 'guardians'])->findOrFail($user->id);

        $user->students->map(function ($student) {
            $student->full_name = $student->full_name;
            $student->full_name_kana = $student->full_name_kana;
            return $student;
        });

        $user->guardians->map(function ($guardian) {
            $guardian->full_name = $guardian->full_name;
            $guardian->full_name_kana = $guardian->full_name_kana;
            return $guardian;
        });

        $user->userAddresses->map(function ($userAddress) {
            $userAddress->full_address = $userAddress->full_address;
            return $userAddress;
        });

        return Inertia::render('Admin/Users/Show', [
            'user' => $user,
            'userAddresses' => $user->userAddresses ?? [],
        ]);
    }

    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($validated, $user) {
                $user->update($validated);
            });

            return to_route('admin.user.index')->with([
                'message' => 'ユーザー情報を更新しました',
                'status' => 'success',
            ]);

        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with([
                'message' => 'ユーザー情報の更新に失敗しました',
                'status' => 'danger',
            ]);
        }
    }

    public function destroy(User $user)
    {
        try {
            DB::transaction(function () use ($user) {
                $user->delete();
            });

            return to_route('admin.user.index')->with([
                'message' => 'ユーザーを削除しました',
                'status' => 'success',
            ]);

        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with([
                'message' => 'ユーザーの削除に失敗しました',
                'status' => 'danger',
            ]);
        }
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->find($id);

        if (!$user) {
            return redirect()->back()->with([
                'message' => 'ユーザーが見つかりません',
                'status' => 'danger',
            ]);
        }

        try {
            DB::transaction(function () use ($user) {
                $user->restore();
            });

            return to_route('admin.user.index')->with([
                'message' => 'ユーザーを復活しました',
                'status' => 'success',
            ]);

        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with([
                'message' => 'ユーザーの復活に失敗しました',
                'status' => 'danger',
            ]);
        }
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->find($id);

        if (!$user) {
            return redirect()->back()->with([
                'message' => 'ユーザーが見つかりません',
                'status' => 'danger',
            ]);
        }

        try {
            DB::transaction(function () use ($user) {
                $user->forceDelete();
            });

            return to_route('admin.user.index')->with([
                'message' => 'ユーザーを完全削除しました',
                'status' => 'success',
            ]);

        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with([
                'message' => 'ユーザーの完全削除に失敗しました',
                'status' => 'danger',
            ]);
        }
    }

    // 一括登録
    public function bulkCreate()
    {
        return Inertia::render('Admin/Users/BulkCreate');
    }

    // メールアドレスがユニークかどうかを確認
    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $exists = User::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }
}
