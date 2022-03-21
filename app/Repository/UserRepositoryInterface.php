<?php

namespace App\Repository;

use App\Model\User;
// use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use App\Http\Requests\RegistrationFormRequest;
use Illuminate\Contracts\Routing\ResponseFactory;

interface UserRepositoryInterface
{
   public function all(): Collection;

   public function login(Request $request);
   public function logout(Request $request);
   public function verify(Request $request);
   public function register(RegistrationFormRequest $request);
}
