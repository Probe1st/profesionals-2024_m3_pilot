<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) {

        $credentials = Validator::make($request->all(), [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'string', 'unique:users'],
            'document_number' => ['required', 'string','max:10'],
            'password' => ['required', 'string'],
        ]);

        if($credentials->fails()) {
            return response()->json([
                'error' => [
                    'code' => '422',
                    'message' => 'Validation error',
                    'errors' => $credentials->errors()
                ]
            ], 422);
        }

        $user = [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'phone' => $request->get('phone'),
            'document_number' => $request->get('document_number'),
            'password' => $request->get('password'),
        ];

        if(Auth::attempt($user)) {
            // $request->session()->regenerate();

            // $request->session()->regenerateToken();

            return response()->json([], 204);
        }

        return response()->json([
            "data" => Auth::attempt( ['phone' => $request->get('phone'), 'password' => $request->get('password')] )
        ], 400);
    }
}
