<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\hasMiddleware;
use App\Models\Lesson;
use App\http\Resources\LessonResource;
use Illuminate\Support\Facades\Gate as FacadesGate;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limet =  $request->input('limet') <= 25 ? $request->input('limet') : 25;
        $lesson = LessonResource::collection(Lesson::paginate($limet));
        return $lesson->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lesson = new LessonResource(Lesson::create($request->all()));
        return $lesson->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lesson = new LessonResource(Lesson::findOrFail($id));
        return $lesson->response()->setStatusCode(200)->setStatusCode(200,'Lesson Returned Scccfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $idLesson = Lesson::findOrFail($id);
        FacadesGate::authorize('update',$idLesson);
        $lesson = new LessonResource(Lesson::findOrFail($id));
        $lesson = $lesson->update($request->all());
        return $lesson->response()->setStatusCode(200,'Lesson Update Scccfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $idLesson = Lesson::findOrFail($id);
        FacadesGate::authorize('delete',$idLesson);
        $idLesson ->delete();
        return 204;
    }
}
