<?php

namespace App\Http\Controllers;

use App\Services\Task\Service;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $service;

    public function __construct(Service $service) {
        $this->service = $service;
    }
}
