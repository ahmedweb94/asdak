<?php

namespace App\Helper\Traits;

use Symfony\Component\HttpFoundation\Response;

trait RESTApi
{

    /**
     * Return response with json object
     * @param $responseObject , $responseKey, $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendJson($responseObject, $statusCode = Response::HTTP_OK, $responseKey = 'data')
    {
        if ($responseObject)
            $jsonResponse[$responseKey] = $responseObject;
//        return response($responseObject, $statusCode);
        $jsonResponse['statusCode'] = $statusCode;
        return response($jsonResponse, $statusCode);
    }


    /**
     * Return response with error object
     * @param $errorObject , $errorKey, $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($errorObject, $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY, $errorKey = 'errors')
    {
        $errorResponse[$errorKey] = $errorObject;
        //return response($errorObject, $statusCode);
        $errorResponse['statusCode'] = $statusCode;
        return response($errorResponse, $statusCode);
    }

    public function sendRedirectError($errorObject, $statusCode = Response::HTTP_PERMANENTLY_REDIRECT, $errorKey = 'errors')
    {
        // $errorResponse['statusCode'] = $statusCode;
        // $errorResponse[$errorKey] = $errorObject;
        return response($errorObject, $statusCode);
    }

    public function sendMessage($responseObject, $statusCode = Response::HTTP_ACCEPTED, $responseKey = 'data')
    {
        if ($responseObject){
            $jsonResponse[$responseKey] = $responseObject;
        }
//        return response($responseObject, $statusCode);
        $jsonResponse['statusCode'] = $statusCode;
        return response($jsonResponse, $statusCode);
    }

}


