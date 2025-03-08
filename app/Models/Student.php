<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Models\BaseModel;
use App\Constants\SortOrder;

class Student extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Relationship
    public function users()
    {
        return $this->belongsToMany(User::class, 'student_user');
    }

    public function studentEnrollment()
    {
        return $this->hasOne(StudentEnrollment::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class)->withTrashed();
    }

    public function Events()
    {
        return $this->belongsToMany(Event::class, 'event_applications')->withPivot('application_date', 'cancel_date', 'status', 'remarks', 'is_paid')->withTimestamps();
    }

    public function eventApplications()
    {
        return $this->hasMany(EventApplication::class)->withTrashed();
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_student')->withTimestamps();
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_student')->withPivot('id')->withTimestamps();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id')->withPivot('id')->withTimestamps();
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_student')->withPivot('id')->withTimestamps();
    }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'schedule_student')->withPivot('id', 'student_id', 'schedule_id')->withTimestamps();
    }

    public function studentAttendances()
    {
        return $this->hasMany(StudentAttendance::class, 'student_id');
    }

    public function feeAmounts()
    {
        return $this->belongsToMany(FeeAmount::class, 'payment_logs')->withPivot('id', 'payment_date', 'is_paid')->withTimestamps();
    }

    // public function studentEvaluations()
    // {
    //     return $this->hasMany(StudentEvaluation::class, 'student_id');
    // }

    public function bankTransfers()
    {
        return $this->hasMany(BankTransfer::class, 'member_id', 'serial_no');
    }

    public function creditTransactions()
    {
        return $this->hasMany(CreditTransaction::class, 'Member_id', 'serial_no');
    }

    /* ----- Scope ----- */
    // 全生徒を最新順に取得するスコープ
    public function scopeAllStudents(Builder $query)
    {
        return $query;
    }
    // 会員を取得するスコープ
    public function scopeEnrolledStudents(Builder $query)
    {
        return $query->whereHas('studentEnrollment', function ($query) {
            $query->whereNotNull('enrollment_date')->whereNull('withdrawal_date');
        })
            ->where('membership_status', '会員')
            ->whereNotNull('member_no');
    }
    // 非会員を取得するスコープ
    public function scopeNonMemberStudents(Builder $query)
    {
        return $query->where('membership_status', '非会員');
    }
    // 休会者を取得するスコープ
    public function scopeSuspendedStudents(Builder $query)
    {
        return $query->whereHas('studentEnrollment', function ($query) {
            $query->whereNotNull('suspension_start_date')->whereNull('withdrawal_date');
        });
    }
    // 新規入会者を取得するスコープ
    public function scopeNewStudents(Builder $query, $oneMonthAgo)
    {
        return $query->whereHas('studentEnrollment', function ($query) use ($oneMonthAgo) {
            $query->where('enrollment_date', '>=', $oneMonthAgo)
                ->whereNull('withdrawal_date');
        });
    }
    // 新規申込者を取得するスコープ
    public function scopeNewApplicationStudents(Builder $query, $oneMonthAgo)
    {
        return $query->whereHas('studentEnrollment', function ($query) use ($oneMonthAgo) {
            $query->where('application_date', '>=', $oneMonthAgo)
                ->whereNull('withdrawal_date');
        });
    }
    // 仮会員を取得するスコープ
    public function scopeTemporaryStudents(Builder $query)
    {
        return $query->where('is_temporary', true);
    }

    // 名前順にソートするスコープ
    public function scopeSortOrder(Builder $query, $sortOrder)
    {
        if ($sortOrder === null || $sortOrder === SortOrder::Latest) {
            return $query->orderBy('created_at', 'desc');
        } elseif ($sortOrder === SortOrder::Oldest) {
            return $query->orderBy('created_at', 'asc');
        } elseif ($sortOrder === SortOrder::LastNameKana_Asc) {
            return $query->orderBy('lastname_kana', 'asc')->orderBy('firstname_kana', 'asc');
        } elseif ($sortOrder === SortOrder::LastNameKana_Desc) {
            return $query->orderBy('lastname_kana', 'desc')->orderBy('firstname_kana', 'desc');
        } elseif ($sortOrder === SortOrder::FirstNameKana_Asc) {
            return $query->orderBy('firstname_kana', 'asc')->orderBy('lastname_kana', 'asc');
        } elseif ($sortOrder === SortOrder::FirstNameKana_Desc) {
            return $query->orderBy('firstname_kana', 'desc')->orderBy('lastname_kana', 'desc');
        }
    }

    public function scopeFilterByCourse(Builder $query, $courseId)
    {
        if ($courseId) {
            // コースIDでフィルタリング
            return $query->whereHas('courses', function ($query) use ($courseId) {
                $query->where('courses.id', $courseId);
            });
        }
        return $query;
    }

    // 検索キーワードで絞り込むスコープ
    public function scopeSearchKeyword($query, $keyword)
    {
        if (!is_null($keyword)) {
            // スペースを取り除く
            $spaceConvert = mb_convert_kana($keyword, 's');
            // キーワードを分割
            $keywords = preg_split('/[\s]+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY);

            // 複数のキーワードをOR条件で適用
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere(function ($q) use ($word) {
                        $q->where('students.lastname', 'like', '%' . $word . '%')
                            ->orWhere('students.firstname', 'like', '%' . $word . '%')
                            ->orWhere('students.lastname_kana', 'like', '%' . $word . '%')
                            ->orWhere('students.firstname_kana', 'like', '%' . $word . '%');
                    });
                }
            });
        }
        return $query; // すべてのレコードを返すために、$queryを返します
    }
}
