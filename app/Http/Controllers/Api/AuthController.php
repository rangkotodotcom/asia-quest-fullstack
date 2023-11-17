<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'code'      => 400,
                'content'   => $validator->errors(),
                'message'   => 'Validation Error'
            ], 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $dataResponse['name'] = $user->name;
        $dataResponse['email'] = $user->email;
        $dataResponse['token'] =  $user->createToken('MyApp')->plainTextToken;

        $response = [
            'status'    => true,
            'code'      => 201,
            'content'   => $dataResponse,
            'message'   => 'User register successfully'
        ];

        return response()->json($response, $response['code']);
    }


    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $dataResponse['name'] = $user->name;
            $dataResponse['email'] = $user->email;
            $dataResponse['token'] =  $user->createToken('MyApp')->plainTextToken;

            $response = [
                'status'    => true,
                'code'      => 200,
                'content'   => $dataResponse,
                'message'   => 'User login successfully.'
            ];
        } else {
            $response = [
                'status'    => false,
                'code'      => 401,
                'content'   => [],
                'message'   => 'Unauthorised'
            ];
        }

        return response()->json($response, $response['code']);
    }
}
