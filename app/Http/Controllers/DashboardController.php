<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class DashboardController extends Controller
{
  /**
   * @var
   */
  protected $user;

  /**
   * DashboardController constructor.
   */
  public function __construct()
  {
    
  }


  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function getToken(Request $request)
  {
    // $token = csrf_token();
    $token = $request->cookies->get('XSRF-TOKEN');
    // return $token;
    return response()->json([
      'success' => true,
      'token' => $token,
    ]);
  }


  /**
   * @return \Illuminate\Http\JsonResponse
   */
  public function index()
  {
    $this->user = JWTAuth::parseToken()->authenticate();
    return response()->json([
      'success'   =>  true,
      'data'      =>  $this->user
    ], 200);
  }
}
