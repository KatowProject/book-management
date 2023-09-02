<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User as ModelsUser;
use CodeIgniter\API\ResponseTrait;


class User extends BaseController
{   
    use ResponseTrait;

    public function index()
    {
        $model = new ModelsUser();

        $users = $model->findAll();
        // hide password
        foreach ($users as $key => $user) {
            unset($users[$key]['password']);
        }

        return $this->respond($users, 200);
    }
}