<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;
use TCG\Voyager\Models\User;
use Validator;


class ApiAuthController extends Controller
{

    public $loginAfterSignUp = true;

    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|unique:users|max:255',
            'password' => 'required',
        ]);

        if ($v->fails())
        {
            return response(['email is already exist']);
        }
        if($request->has('avatar')){
        $fileName= 'users/apis/'.time().$request->avatar->getClientOriginalName();
        $request->avatar->move(public_path('../storage/app/public/users/apis'), $fileName);
        }
        else{
            $fileName='users/default.png';
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' => $fileName,
            'birth' => $request->birth,
            'sex' => $request->sex,
            'type' => $request->type,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'country_id' => $request->country_id,
            'email_verified_at' => now(),
        ]);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function getAuthUser(Request $request)
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message'=>'Successfully logged out']);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


}
