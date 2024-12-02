<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAuth;
use Illuminate\Support\Facades\Auth;
use Hash;
use Validator;

class UserAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:50|unique:user_auths',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $userAuth = UserAuth::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $userAuth->createToken('5BAWI40')->plainTextToken;
        return response()->json(['datos' => $userAuth, 'token' => $token]);

    }

    public function login(Request $request){
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Usuario y/o contraseña no validos'
                                        ], 401);
        }

        $userAuth = UserAuth::whrer('email', $request['email'])->firstOrFail();
        $token = $userAuth->createToken('5BAWI40')->plainTextToken;

        return response()->json(['user' => $userAuth,
                                    'token' => $token
                                    ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(UserAuth $userAuth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAuth $userAuth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserAuth $userAuth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAuth $userAuth)
    {
        //
    }
}
