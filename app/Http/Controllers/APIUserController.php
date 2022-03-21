<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\UserRepositoryInterface;
use App\Http\Requests\RegistrationFormRequest;

class APIUserController extends Controller
{

  private $userRepository;

  /**
   * Create a new AuthController instance.
   *
   * @return void
   */

  public function __construct(UserRepositoryInterface $userRepository)
  {
    $this->userRepository = $userRepository;
    // $this->middleware('auth:api', ['except' => ['login','register']]);
  }

  /**
   * @var bool
   */
  public $loginAfterSignUp = true;

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(Request $request)
  {
    return $this->userRepository->login($request);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   * @throws \Illuminate\Validation\ValidationException
   */
  public function logout(Request $request)
  {
    // $this->validate($request, [
    //   'token' => 'required'
    // ]);

    return $this->userRepository->logout($request);
  }

  /**
   * @param RegistrationFormRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function register(RegistrationFormRequest $request)
  {
    return $this->userRepository->register($request);
  }
  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function verify(Request $request)
  {
    return $this->userRepository->verify($request);
  }

}
