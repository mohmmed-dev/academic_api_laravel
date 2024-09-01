<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RelationshipController;



Route::group(['prefix'=> '/v1'], function () {
    Route::apiResource('lessons', LessonController::class)->middleware('auth:api');
    Route::apiResource('users', UserController::class)->middleware('auth:api');
    Route::apiResource('tags', TagController::class)->middleware('auth:api');
    Route::get('users/{id}/lessons', [RelationshipController::class,'userLessons']);
    Route::get('lessons/{id}/tags', [RelationshipController::class,'lessonTaga']);
    Route::get('tags/{id}/lessons', [RelationshipController::class,'tagLessons']);
    Route::post('login', [LoginController::class,'login']);
    Route::post('register', [UserController::class,'store']);
    Route::redirect('lesson','lessons');
    Route::redirect('user','users');
    Route::redirect('tag','tags');
});
