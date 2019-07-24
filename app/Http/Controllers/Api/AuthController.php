<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthRequest;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use App\Topic;
use App\Transformers\TopicTransformer;

class AuthController extends Controller
{
    use Helpers;

    public function login(AuthRequest $request)
    {
//        dd($request->all());
        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized();
        }

        return $this->response->array(['token' => $token]);
    }

    public function me(UserTransformer $transformer)
    {
        return $this->response->item(auth('api')->user(), $transformer);
    }

    public function userIndex(UserTransformer $transformer)
    {
        $users = User::paginate();
        return $this->response->paginator($users, $transformer);
//        $users = User::all();
//        return $this->response->collection($users, $transformer);
    }

    public function topicIndex(TopicTransformer $transformer)
    {
        $topics = Topic::paginate();
        return $this->response->paginator($topics, $transformer,['key' => 'topic']);
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