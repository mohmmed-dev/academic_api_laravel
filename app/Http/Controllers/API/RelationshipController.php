<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Tag;

class RelationshipController extends Controller
{
    public function userLessons($id){
        $user = user::findOrFail($id)->lessons;
        $fileds = array();
        $filtered = array();
        foreach ($user as $lesson) {
            $fileds['Title'] = $lesson->title;
            $fileds['Content'] = $lesson->body;
            $filtered[] = $fileds;
        };
        return response()->json([
            'data' => $filtered
        ],200);
    }
    public function lessonTaga($id){
        $lesson = Lesson::findOrFail($id)->tags;
        $fileds = array();
        $filtered = array();
        foreach ($lesson as $tag) {
            $fileds['Name'] = $tag->name;
            $filtered[] = $fileds;
        };
        return response()->json([
            'data' => $filtered
        ],200);
    }
    public function tagLessons($id){
        $tag = tag::findOrFail($id)->lessons;
        $fileds = array();
        $filtered = array();
        foreach ($tag as $lesson) {
            $fileds['Title'] = $lesson->title;
            $fileds['Content'] = $lesson->body;
            $filtered[] = $fileds;
        };
        return response()->json([
            'data' => $filtered
        ],200);
    }
}
