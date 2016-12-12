<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 * @package App\Http\Controllers\Api
 */
class LoginController extends Controller
{

    /**
     * @param Request $request
     * @return mixed|string
     */
    public function login(Request $request)
    {

        $v = Validator::make($request->all(), [
            $this->loginField() => 'required',
            'password' => 'required',
        ]);

        if ($v->fails()) {
            return response()->json($v->errors(), 409);
        }

        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            $user = $request->user();
            $this->generateApiToken($user);
            return $user;
        } else {
            return response()->json(['email' => 'Email or password are wrong'], 409);
        }

    }

    private function generateApiToken(User $user)
    {
        $user->api_token = str_random(60);
        $user->save();
    }

    /**
     * Get the login field to be used by the controller.
     *
     * @return string
     */
    public function loginField()
    {
        return 'email';
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->loginField(), 'password');
    }


}