<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Book as BookModel;
use CodeIgniter\API\ResponseTrait;
use Config\Services;

class Book extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $bookModel = new BookModel();

        $books = $bookModel->findAll();

        return $this->respond($books, 200);
    }

    public function show($id)
    {
        $bookModel = new BookModel();

        $book = $bookModel->find($id);

        return $this->respond($book, 200);
    }

    public function create()
    {
        $bookModel = new BookModel();

        $book = [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'publisher' => $this->request->getPost('publisher'),
            'year' => $this->request->getPost('year'),
            'total_page' => $this->request->getPost('total_page'),
            'price' => $this->request->getPost('price')
        ];

        if ($this->request->getFile('image')) {
            $book['image'] = $this->request->getFile('image')->getName();
        }

        $validation = Services::validation();
        $validation->setRules($bookModel->getValidationRules());

        if (!$validation->run($book)) {
            $response = [
                'status' => 400,
                'error' => [
                    'message' => $validation->getErrors()
                ]
            ];

            return $this->respond($response, 400);
        }

        $bookModel->insert($book);

        $response = [
            'status' => 201,
            'error' => null,
            'message' => [
                'success' => 'Book created successfully'
            ]
        ];

        // save image
        $this->request->getFile('image')->move('./uploads');

        return $this->respondCreated($response, 201);
    }
}
