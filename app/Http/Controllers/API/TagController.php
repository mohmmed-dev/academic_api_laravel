<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Resources\TagResource;
use Illuminate\Support\Facades\Gate as FacadesGate;


class TagController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limet =  $request->input('limet') <= 30 ? $request->input('limet') : 30;
        $tags = TagResource::collection(Tag::paginate($limet));
        return  $tags->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        FacadesGate::authorize('create',Tag::class);
        $tag = new TagResource(Tag::create($request->all()));
        return $tag->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = new TagResource(Tag::findOrFail($id));
        return $tag->response()->setStatusCode(200)->setStatusCode(200,'Tag Returned Scccfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $idTag = Tag::findOrFail($id);
        FacadesGate::authorize('update',$idTag);
        $tag = new TagResource(Tag::findOrFail($id));
        $tag->update($request->all());
        return $tag->response()->setStatusCode(200)->setStatusCode(200,'Tag Update Scccfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $idTag = Tag::findOrFail($id);
        FacadesGate::authorize('delete',$idTag);
        $idTag->delete();
        return 204;
    }
}
