<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     ** path="/auth/register",
     *   tags={"Auth"},
     *   summary="Register",
     *   operationId="register",
     *   security={{"bearerAuth": {}}},
     *
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="password_confirmation",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(response=201,description="Success",@OA\MediaType( mediaType="application/json",)),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=400,description="Bad Request"),
     *   @OA\Response(response=404,description="not found"),
     *   @OA\Response(response=403,description="Forbidden")
     *)
     **/
    public function register(Request $request)
    {
        $admin = $request->user();
        if ($admin['type'] == 1) {
            $response = ['error' => 'Không có quyền'];
            return response($response, 403);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);
            if ($validator->fails()) {
                return response(['error' => $validator->errors()->all()], 422);
            }
            $request['password'] = Hash::make($request['password']);
            $request['remember_token'] = Str::random(10);
            $user = new User();
            $user->email = $request['email'];
            $user->password = $request['password'];
            $user->name = $request['name'];
            $user->remember_token = $request['remember_token'];
            $user->type = 1;
            $user->status = 0;
            $token = $user->createToken('Token')->accessToken;
            $user->save();
            $response = ['token' => $token];
            return response($response, 201);
        }
    }

    /**
     * @OA\Post(
     ** path="/auth/login",
     *   tags={"Auth"},
     *   summary="Login",
     *   operationId="login",
     *  security={
     *         {"bearerAuth": {}}
     *     },
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(response=201,description="Success",@OA\MediaType( mediaType="application/json",)),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=400,description="Bad Request"),
     *   @OA\Response(response=404,description="not found"),
     *   @OA\Response(response=403,description="Forbidden")
     *)
     **/
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response(['error' => $validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Token')->accessToken;
                $response = ['token' => $token];
                return response($response, 201);
            } else {
                $response = ['message' => 'Error Password'];
                return response($response, 422);
            }
        } else {
            $response = ['message' => 'Email not exist'];
            return response($response, 422);
        }
    }

    /**
     * @OA\Get(
     ** path="/auth/logout",
     *   tags={"Auth"},
     *   summary="Logout",
     *   operationId="logout",
     *  security={
     *         {"bearerAuth": {}}
     *     },
     *   @OA\Response(response=201,description="Success",@OA\MediaType( mediaType="application/json",)),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=400,description="Bad Request"),
     *   @OA\Response(response=404,description="not found"),
     *   @OA\Response(response=403,description="Forbidden")
     *)
     **/
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $response = ['message' => 'Logout success'];
        return response($response, 201);
    }

    /**
     * @OA\Get(
     ** path="/auth/getUser",
     *   tags={"Auth"},
     *   summary="User Information",
     *   operationId="getUser",
     *  security={
     *         {"bearerAuth": {}}
     *     },
     *   @OA\Response(response=201,description="Success",@OA\MediaType( mediaType="application/json",)),
     *   @OA\Response(response=401,description="Unauthenticated"),
     *   @OA\Response(response=400,description="Bad Request"),
     *   @OA\Response(response=404,description="not found"),
     *   @OA\Response(response=403,description="Forbidden")
     *)
     **/
    public function getUser(Request $request)
    {
        $response = $request->user();
        return response()->json($response);
    }
}
