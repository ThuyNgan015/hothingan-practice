<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;

class UsersController extends Controller
{
    public function index()
    {
        $users = Users::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $user = Users::create($request->all());
        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = Users::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = Users::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        Users::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
