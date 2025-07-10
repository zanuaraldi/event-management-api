<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use App\Models\EventsModel;
use Laravel\Lumen\Routing\Controller as BaseController;

class UsersController extends BaseController
{
    public function index(){
        return UsersModel::all();
    }
}
