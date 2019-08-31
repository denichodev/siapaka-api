<?php

namespace App\Http\Controllers;

class IndexController extends RestController
{
  public function index()
  {
    return $this->response([
      'name' => 'Test API',
      'version' => 0.1
    ]);
  }
}
