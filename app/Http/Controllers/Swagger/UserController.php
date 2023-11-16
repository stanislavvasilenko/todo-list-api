<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


/**
 * @OA\Post(
 *  path="/api/auth/login",
 *  summary="Access",
 *  tags={"User"},
 * 
 *  @OA\RequestBody(
 *      request="some request",
 *      @OA\JsonContent(
 *          allOf={
 *              @OA\Schema(
 *                  @OA\Property(property="email", type="string"),
 *                  @OA\Property(property="password", type="string"),
 *                  example={"email": "email@gmail.com", "password": "11111111"}
 *              )
 *          }
 *      )
 *  ),
 * 
 *  @OA\Response(
 *      response=200,
 *      description="Ok",
 *      @OA\JsonContent(
 *              @OA\Property(property="access_token", type="string"),
 *              @OA\Property(property="token_type", type="string"),
 *              @OA\Property(property="expires_id", type="integer"),
 *              example={"access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3MDAwMDA0NzAsImV4cCI6MTcwMDAwNDA3MCwibmJmIjoxNzAwMDAwNDcwLCJqdGkiOiI4YkNIeGd5UUxhRlZ4czRLIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.LWELjMOB8hLO5Qm_x0F-6d5ZcVn2cHLMel1hInWvOSE", "token_type": "bearer", "expires_id": 3600}
 *      ),
 *  ),
 * ),
 */
class UserController extends Controller
{
    //
}
