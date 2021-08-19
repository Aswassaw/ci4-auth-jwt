<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\JWTCheck;
use App\Models\UserModel;

class Me extends ResourceController
{
  use ResponseTrait;

  /**
   * Return an array of resource objects, themselves in array format
   *
   * @return mixed
   */
  public function index()
  {
    $header_authorization = $this->request->getHeaderLine('Authorization');
    $check = new JWTCheck();
    $check_result = $check->check($header_authorization);

    // Jika check jwt gagal
    if (!$check_result[0]) {
      return $this->failUnauthorized($check_result[1]);
    }

    $model = new UserModel();
    $user = $model->select("id, email")->find($check_result[1]->uid);

    return $this->respond([
      "status" => 200,
      "message" => "Request success.",
      "data" => $user,
    ]);
  }
}
