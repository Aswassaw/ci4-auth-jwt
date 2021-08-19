<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Firebase\JWT\JWT;

class Login extends ResourceController
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
      'email' => 'required|valid_email',
      'password' => 'required',
    ];

    // Validasi
    if (!$this->validate($rules)) {
      return $this->fail($this->validator->getErrors());
    }

    $model = new UserModel();
    $user = $model->where("email", $this->request->getVar('email'))->first();

    // Jika user tidak ditemukan
    if (!$user) {
      return $this->failNotFound("User can't be found.");
    }

    // Jika password salah
    if (!password_verify($this->request->getVar('password'), $user['password'])) {
      return $this->failForbidden("Wrong password.");
    }

    $key = JWT_KEY;
    $payload = [
      "iat" => 1356999524,
      "nbf" => 1357000000,
      "uid" => $user['id'],
    ];

    $jwt = JWT::encode($payload, $key);

    return $this->respond([
      "status" => "200",
      "message" => "Login success.",
      "jwt" => $jwt,
    ]);
  }
}
