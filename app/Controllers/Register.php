<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class Register extends ResourceController
{
  use ResponseTrait;

  /**
   * Return an array of resource objects, themselves in array format
   *
   * @return mixed
   */
  public function index()
  {
    helper(['form']);
    $rules = [
      'email' => 'required|valid_email|is_unique[users.email]',
      'password' => 'required|min_length[8]',
      'password_confirm' => 'matches[password]',
    ];

    // Validasi
    if (!$this->validate($rules)) {
      return $this->fail($this->validator->getErrors());
    }

    $data = [
      'email' => $this->request->getVar('email'),
      'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
    ];

    $model = new UserModel();
    $model->save($data);

    return $this->respondCreated([
      "status" => 201,
      "message" => "User registered.",
      "data" => $data,
    ]);
  }
}
