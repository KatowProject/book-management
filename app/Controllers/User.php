<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User as ModelsUser;
use CodeIgniter\API\ResponseTrait;
use Config\Services;


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

    public function show($id)
    {
        $model = new ModelsUser();

        $users = $model->find($id);

        if (!$users) {
            return $this->failNotFound('User not found');
        }

        // hide password
        unset($users['password']);

        return $this->respond($users, 200);
    }

    public function create()
    {
        $model = new ModelsUser();

        $user = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role' => $this->request->getPost('role'),
        ];

        $validation = Services::validation();
        $validation->setRules($model->getValidationRules());

        if (!$validation->run($user)) {
            $response = [
                'status' => 400,
                'error' => [
                    'message' => $validation->getErrors()
                ]
            ];

            return $this->respond($response, 400);
        }

        $model->insert($user);

        $response = [
            'status' => 201,
            'error' => null,
            'message' => 'User created successfully'
        ];

        return $this->respond($response, 201);
    }
}
