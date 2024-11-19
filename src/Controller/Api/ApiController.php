<?php

namespace App\Controller\Api;

use App\Controller\BaseController;
use App\Service\Deserializer;
use App\Service\ValidationErrorHandlerService;

class ApiController extends BaseController
{
    /** @var ValidationErrorHandlerService */
    protected ValidationErrorHandlerService $validationErrorHandler;
    /**
     * @var Deserializer
     */
    protected Deserializer $deserializer;

    public function __construct(
        ValidationErrorHandlerService $validationErrorHandlerService,
        Deserializer                  $deserializer
    )
    {
        $this->validationErrorHandler = $validationErrorHandlerService;
        $this->deserializer = $deserializer;
    }
}