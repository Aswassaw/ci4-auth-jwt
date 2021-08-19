<?php

namespace App\Libraries;

use Firebase\JWT\JWT;

class JWTCheck
{
  public function check($jwt)
  {
    $key = JWT_KEY;

    // Jika tidak ada header Authorization
    if (!$jwt) {
      return [false, "You can't access this resource, jwt token required."];
    }

    try {
      // Decode token
      $token_decoded = JWT::decode($jwt, $key, ["HS256"]);

      return [true, $token_decoded];
    } catch (\Exception $e) {
      return [false, "You can't access this resource, jwt token wrong."];
    }
  }
}
