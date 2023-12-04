<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Traits\HasApiResponse;
use App\Http\Controllers\Controller;

    /**
     * @OA\Info(
     *    title="Swagger with Laravel",
     *    version="1.0.0",
     * )
     * @OA\SecurityScheme(
     *     type="http",
     *     name="bearerAuth",
     *     securityScheme="bearerAuth",
     *     scheme="bearer",
     *     bearerFormat="JWT"
     * )
    */
class ApiController extends Controller
{
    use HasApiResponse;
}
