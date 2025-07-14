<?php

namespace App\Http\Controllers;

use App\Models\OrganizersModel;
use Laravel\Lumen\Routing\Controller as BaseController;

class OrganizersController extends BaseController
{
    public function index(){
        return OrganizersModel::all();
    }
}
