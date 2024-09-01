<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limet =  $request->input('limet') <= 15 ? $request->input('limet') :15;
        $users = UserResource::collection(User::paginate($limet));
        return $users->response()->setStatusCode(200) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        FacadesGate::authorize('create',User::class);
        $user = new UserResource(User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        ));
        return $user->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = new UserResource(User::findOrFail($id));
        return $user->response()->setStatusCode(200,'User Returned Scccfully')->header('Additonal Header','True');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $idUser = User::findOrFail($id);
        FacadesGate::authorize('update', $idUser);
        $user = new UserResource(User::findOrFail($id));
        $user->update($request->all());
        return $user->response()->setStatusCode(200,'User Update Scccfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        FacadesGate::authorize('delete', $user);
        $user->delete();
        return 204;
    }
}
