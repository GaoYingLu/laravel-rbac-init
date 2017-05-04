<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return int
     */
    public function getUserId(){

        $user = $this->getUser();

        return (isset($user['id']) && $user['id'] > 0) ? $user['id'] : 0;

    }

    /**
     * @return mixed
     */
    public function getUser(){

        return Session::get(env('_USER_SESSION_'));

    }

}
