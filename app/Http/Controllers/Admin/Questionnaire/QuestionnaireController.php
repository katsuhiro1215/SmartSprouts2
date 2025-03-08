<?php

namespace App\Http\Controllers\Admin\Questionnaire;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionnaireRequest;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionnaireController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20); // デフォルトは20件
        // 全学校一覧、削除済み学校一覧を取得
        $allQuestionnaires = Questionnaire::select('id', 'name', "status", 'created_at')->latest()->paginate($perPage);
        $questionnaires = Questionnaire::withoutTrashed()->select('id', 'name', "status", 'created_at')->latest()->paginate($perPage);
        $deletedQuestionnaires = Questionnaire::onlyTrashed()->select('id', 'name', "status", 'created_at')->latest()->paginate($perPage);

        return Inertia::render('Admin/Questionnaire/Index', [
            'allQuestionnaires' => $allQuestionnaires,
            'questionnaires' => $questionnaires,
            'deletedQuestionnaires' => $deletedQuestionnaires,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Questionnaire/Create');
    }

    public function store(QuestionnaireRequest $request)
    {
        //
    }

    public function show(Questionnaire $questionnaire)
    {
        return Inertia::render('Admin/Questionnaire/Show', [
            'questionnaire' => $questionnaire->load('questions')
        ]);
    }

    public function edit(Questionnaire $questionnaire)
    {
        return Inertia::render('Admin/Questionnaire/Edit', [
            'questionnaire' => $questionnaire
        ]);
    }

    public function update(QuestionnaireRequest $request, Questionnaire $questionnaire)
    {
        //
    }

    public function destroy(Questionnaire $questionnaire)
    {
        //
    }
}
