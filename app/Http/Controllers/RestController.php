<?php

namespace App\Http\Controllers;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;

class RestController extends Controller
{
  protected $manager;

  protected $transformer_name;

  public function __construct()
  {
    $this->manager = new Manager;
  }

  protected function prepareItem($data, $transformer_name = null)
  {
    if (is_null($transformer_name)) {
      $item = new Item($data, new $this->transformer_name);
    } else {
      $item = new Item($data, new $transformer_name);
    }

    return $this->manager->createData($item)->toArray();
  }

  protected function prepareCollection($data, $transformer_name = null)
  {
    if (is_null($transformer_name)) {
      $collection = new Collection($data, new $this->transformer_name);
    } else {
      $collection = new Collection($data, new $transformer_name);
    }
    return $this->manager->createData($collection)->toArray();
  }

  public function response($data = null, $status = 200)
  {
    return response()->json($data, $status);
  }

  public function badRequestResponse($data)
  {
    return $this->response($data, 400);
  }

  /**
   * Generates 403 response.
   *
   * @param $data
   * @return \Illuminate\Http\JsonResponse
   */
  public function forbiddenResponse($data)
  {
    return $this->response($data, 403);
  }
  /**
   * Generates 404 response.
   *
   * @param $data
   * @return \Illuminate\Http\JsonResponse
   */
  public function notFoundResponse($data)
  {
    return $this->response($data, 404);
  }
  /**
   * Generates 500 response.
   *
   * @param $data
   * @return \Illuminate\Http\JsonResponse
   */
  public function iseResponse($data)
  {
    return $this->response($data, 500);
  }
  /**
   * Shorthand for 200 response sending Item.
   *
   * @param $data
   * @param null $transformer_name
   * @param int $status
   * @return \Illuminate\Http\JsonResponse
   */
  public function sendItem($data, $transformer_name = null, $status = 200)
  {
    return $this->response($this->prepareItem($data, $transformer_name), $status);
  }
  /**
   * Shorthand for 200 response sending Collection.
   *
   * @param $data
   * @param null $transformer_name
   * @return \Illuminate\Http\JsonResponse
   */
  public function sendCollection($data, $transformer_name = null)
  {
    return $this->response($this->prepareCollection($data, $transformer_name));
  }
}
