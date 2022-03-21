<?php

namespace App\Repository\Eloquent;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repository\UserRepositoryInterface;
use App\Http\Requests\RegistrationFormRequest;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

  /**
   * UserRepository constructor.
   *
   * @param User $model
   */
  public function __construct(User $model)
  {
    parent::__construct($model);
  }

  /**
   * @return Collection
   */
  public function all(): Collection
  {
    return $this->model->all();
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(Request $request)
  {
    $input = $request->only('email', 'password');
    $token = null;

    if (!$token = JWTAuth::attempt($input)) {
      return response()->json([
        'success' => false,
        'message' => 'Invalid Email or Password',
      ], 401);
    }

    return response()->json([
      'success' => true,
      'token' => $token,
    ]);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   * @throws \Illuminate\Validation\ValidationException
   */
  public function logout(Request $request)
  {
    try {
      JWTAuth::invalidate($request->token);

      return response()->json([
        'success' => true,
        'message' => 'User logged out successfully'
      ]);
    } catch (JWTException $exception) {
      return response()->json([
        'success' => false,
        'message' => 'Sorry, the user cannot be logged out'
      ], 500);
    }
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   * @throws \Illuminate\Validation\ValidationException
   */
  public function verify(Request $request)
  {
    try {
      // JWTAuth::validate($request->token);
      $user = JWTAuth::parseToken()->authenticate();

      if ($user = JWTAuth::parseToken()->authenticate()) {
        return response()->json([
          'success' => true,
          'message' => 'User verified successfully',
          'user' => $user
        ]);
      } else {
        return response()->json([
          'success' => false,
          'message' => 'Sorry, the user cannot be logged out'
        ], 500);
      }

    } catch (JWTException $exception) {
      return response()->json([
        'success' => false,
        'message' => 'Sorry, the user cannot be logged out'
      ], 500);
    }
  }

  /**
   * @param RegistrationFormRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function register(RegistrationFormRequest $request)
  {
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->dob = $request->dob;
    $user->password = bcrypt($request->password);
    $user->save();

    // if ($this->loginAfterSignUp) {
    //   return $this->login($request);
    // }

    return response()->json([
      'success'   =>  true,
      'data'      =>  $user
    ], 200);
  }
}
