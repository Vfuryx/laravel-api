<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Transformers\UserTransformer;

class UsersController extends Controller
{
//    protected $user;
//
//    public function __construct(User $user)
//    {
//        $this->user = $user;
//    }

    public function me()
    {

        return $this->response->item($this->user(), new UserTransformer())->setMeta([
                'access_token' => \Auth::guard('api')->fromUser($this->user()),
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
            ]);
    }
}
