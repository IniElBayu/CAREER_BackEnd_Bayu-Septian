<?php

namespace App\Http\Controllers;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    // GET /api/users
    public function index()
    {
        return response()->json(UserLogin::all());
    }

    // POST /api/users
    public function store(Request $request)
    {
        $user = UserLogin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json($user,201);
    }

    // GET /api/users/{id}
    public function show($id)
    {
        return response()->json(UserLogin::findOrFail($id));
    }

    // PUT /api/users/{id}
    public function update(Request $request, $id)
    {
        $user = UserLogin::findOrFail($id);

        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password
        ]);

        return response()->json($user);
    }

    // DELETE /api/users/{id}
    public function destroy($id)
    {
        $user = UserLogin::findOrFail($id);
        $user->delete();

        return response()->json(['message'=>'User deleted']);
    }
}