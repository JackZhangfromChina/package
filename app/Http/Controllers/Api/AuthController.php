<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthRequest;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    use Helpers;

    public function login(AuthRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized();
        }

        return $this->response->array(['token' => $token]);
    }

    public function me(Request $request)
    {
        dd(auth('api'));
        return auth('api')->user();
    }

    /**
     * Notes:
     * Date: 2019-07-24
     * Time: 09:18
     * @param Request $request
     * author JackZhang
     */
    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth('admin')->attempt($credentials)) {
            return $this->response->errorUnauthorized();
        }

        return $this->response->array(['token' => $token]);
    }

    /**
     * Notes:
     * Date: 2019-07-24
     * Time: 09:18
     * @param Request $request
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     * author JackZhang
     */
    public function admin(Request $request)
    {
        return auth('admin')->user();
    }






}