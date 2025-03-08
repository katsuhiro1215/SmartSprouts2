<?php

namespace App\Http\Controllers\Admin\Person;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardianRequest;
use App\Models\Guardian;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class GuardianController extends Controller
{
    public function index()
    {

        // 全保護者一覧


        return Inertia::render('Admin/Users/Guardians/Index', [
            'guardians' => Guardian::select(),
        ]);
    }

    /**
     * 保護者登録画面を表示
     *
     * @param User $user
     * @return \Inertia\Response
     */
    public function create(User $user): Response
    {
        return Inertia::render('Admin/Users/Guardians/Create', [
            'user' => $user,
        ]);
    }

    /**
     * 保護者登録処理
     *
     * @param GuardianRequest $request
     * @return RedirectResponse
     */
    public function store(GuardianRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        // 生徒写真のアップロード
        if ($request->hasFile('guardian_photo_path')) {
            $validatedData['guardian_photo_path'] = ImageService::uploadUser($request->file('guardian_photo_path'), 'guardians');
        }

        // 保存処理
        try {
            DB::transaction(function () use ($validatedData, $request) {
                $guardian = Guardian::create($validatedData);
                $guardian->users()->attach($request->input('user_id'));

                return $guardian;
            });

            return to_route('admin.guardian.index')->with([
                'message' => '保護者情報の新規登録に成功しました。',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->with([
                'message' => '保護者情報の新規登録に失敗しました。',
            ]);
        }
    }

    /**
     * 保護者詳細画面を表示
     *
     * @param Guardian $guardian
     * @return \Inertia\Response
     */
    public function show(Guardian $guardian)
    {
        return Inertia::render('Admin/Users/Guardians/Show', [
            'guardian' => $guardian,
        ]);
    }

    /**
     * 保護者編集画面を表示
     *
     * @param Guardian $guardian
     * @return \Inertia\Response
     */
    public function edit(Guardian $guardian)
    {
        //
    }

    /**
     * 保護者更新処理
     *
     * @param GuardianRequest $request
     * @param Guardian $guardian
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GuardianRequest $request, Guardian $guardian)
    {
        //
    }

    /**
     * 保護者削除処理
     *
     * @param Guardian $guardian
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Guardian $guardian)
    {
        //
    }
}
