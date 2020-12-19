<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Integration Swagger in Laravel with Passport Auth Documentation",
     *      description="Implementation of Swagger with in Laravel",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url="http://127.0.0.1:8000/api",
     *      description="API TEST"
     * )
     * 
     * @OA\SecurityScheme(
     *      securityScheme="bearerAuth",
     *      in="header",
     *      type="http",
     *      scheme="bearer",
     *      bearerFormat="JWT",
     *      name="Authorization",
     * )
     * 
     * 
     * 
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}
