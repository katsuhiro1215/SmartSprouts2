<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Questionnaire\QuestionnaireController;

// アンケート管理
Route::resource('/questionnaire', QuestionnaireController::class);



