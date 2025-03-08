<?php

namespace App\Http\Controllers\Admin\Person;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\School;
use App\Models\Student;
use App\Models\StudentEnrollment;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }
    
    /**
     * 生徒一覧画面を表示
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        // 1ページあたりの表示件数 (デフォルトは20件)
        $perPage = $request->input('per_page', 20);
        // 1ヶ月前の日付
        $oneMonthAgo = Carbon::now()->subMonth();

        // 検索条件に一致する生徒一覧を取得
        // 全生徒一覧
        $allStudents = StudentResource::collection(
            Student::allStudents()
                ->searchKeyword($request->keyword)
                ->sortOrder($request->sort)
                ->filterByCourse($request->course)
                ->paginate($perPage)
        );
        // 会員一覧
        $enrolledStudents = StudentResource::collection(
            Student::enrolledStudents()
                ->searchKeyword($request->keyword)
                ->sortOrder($request->sort)
                ->filterByCourse($request->course)
                ->paginate($perPage)
        );
        // 非会員一覧
        $nonMemberStudents = StudentResource::collection(
            Student::nonMemberStudents()
                ->searchKeyword($request->keyword)
                ->sortOrder($request->sort)
                ->filterByCourse($request->course)
                ->paginate($perPage)
        );
        // 休会生徒一覧
        $suspendedStudents = StudentResource::collection(
            Student::suspendedStudents()
                ->searchKeyword($request->keyword)
                ->sortOrder($request->sort)
                ->filterByCourse($request->course)
                ->paginate($perPage)
        );
        // 新規入会者生徒一覧
        $newStudents = StudentResource::collection(
            Student::newStudents($oneMonthAgo)
                ->searchKeyword($request->keyword)
                ->sortOrder($request->sort)
                ->filterByCourse($request->course)
                ->paginate($perPage)
        );
        // 新規申込者一覧
        $newApplicationStudents = StudentResource::collection(
            Student::newApplicationStudents($oneMonthAgo)
                ->searchKeyword($request->keyword)
                ->sortOrder($request->sort)
                ->filterByCourse($request->course)
                ->paginate($perPage)
        );
        // 仮登録の生徒一覧
        $temporaryStudents = StudentResource::collection(
            Student::temporaryStudents()
                ->searchKeyword($request->keyword)
                ->sortOrder($request->sort)
                ->filterByCourse($request->course)
                ->paginate($perPage)
        );

        return Inertia::render('Admin/Users/Students/Index', [
            'allStudents' => $allStudents,
            'enrolledStudents' => $enrolledStudents,
            'nonMemberStudents' => $nonMemberStudents,
            'suspendedStudents' => $suspendedStudents,
            'newStudents' => $newStudents,
            'newApplicationStudents' => $newApplicationStudents,
            'temporaryStudents' => $temporaryStudents,
        ]);
    }

    /**
     * 生徒新規登録画面を表示
     *
     * @param User $user
     * @return \Inertia\Response
     */
    public function create(User $user): Response
    {
        return Inertia::render('Admin/Users/Students/Create', [
            'user' => $user,
            'stores' => $user->stores,
        ]);
    }

    /**
     * 生徒新規登録処理
     *
     * @param StudentRequest $request
     * @return RedirectResponse
     */
    public function store(StudentRequest $request): RedirectResponse
    {
        // バリデーション済みデータを取得
        $validatedData = $request->validated();
        
        // 生徒写真のアップロード
        if ($request->hasFile('student_photo_path')) {
            $validatedData['student_photo_path'] = ImageService::uploadUser($request->file('student_photo_path'), 'students');
        }
        // 会員ステータスが「会員」の場合、会員番号を生成
        if ($request->membership_status === '会員') {
            $validatedData['member_no'] = Str::random(8);
        } else {
            $validatedData['member_no'] = null;
        }
        // 保存処理
        try {
            DB::transaction(function () use ($validatedData, $request) {
                $student = Student::create($validatedData);
                // 中間テーブルにデータを保存
                $student->users()->attach($request->input('user_id'), ['store_id' => $request->input('store_id')]);

                return $student;
            });

            return to_route('admin.student.index')->with([
                'message' => '生徒情報の新規登録に成功しました。',
                'status' => 'success',
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with([
                'message' => '生徒情報の新規登録に失敗しました。',
                'status' => 'danger',
            ]);
        }
    }

    /**
     * 生徒詳細画面を表示
     *
     * @param Student $student
     * @return Response
     */
    public function show(Student $student): Response
    {
        return Inertia::render('Admin/Users/Students/Show', [
            'student' => $student,
        ]);
    }

    /**
     * 生徒編集画面を表示
     *
     * @param Student $student
     * @return Response
     */
    public function edit(Student $student): Response
    {
        return Inertia::render('Admin/Users/Students/Edit', [
            'student' => $student,
            'schools' => School::select('id', 'name')->get(),
        ]);
    }

    /**
     * 生徒情報更新処理
     *
     * @param StudentRequest $request
     * @param Student $student
     * @return RedirectResponse
     */
    public function update(StudentRequest $request, Student $student): RedirectResponse
    {

        return to_route('admin.student.show', ['student' => $student->id])->with([
            'message' => '生徒情報の更新に成功しました。',
            'status' => 'success',
        ]);
    }

    public function destroy(Request $request, Student $student): RedirectResponse
    {
        $studentEnrollment = StudentEnrollment::where('student_id', $student->id)->first();

        if (!$studentEnrollment) {
            return redirect()->back()->with([
                'message' => '生徒情報の削除に失敗しました。',
                'status' => 'danger',
            ]);
        }

        $student->membership_status = '非会員';
        $student->save();

        $studentEnrollment->student_id = $student->id;
        $studentEnrollment->withdrawal_date = $request->withdrawal_date;
        $studentEnrollment->withdrawal_reason = $request->withdrawal_reason;
        $studentEnrollment->save();

        $student->delete();

        return to_route('admin.student.index')->with([
            'message' => '生徒情報の削除に成功しました。',
            'status' => 'success',
        ]);
    }
}
