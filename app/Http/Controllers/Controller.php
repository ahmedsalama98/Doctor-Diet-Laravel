<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function sendResponse(array $data=[] ,string $message ='' , int  $statusCode =200){

        $response =[

            'success'=>true,
            'message'=>$message,
            'data'=>$data
        ];
        return response()->json($response ,$statusCode);


    }

    public function sendErrors(array $errors=[] ,string $message ='' , int  $statusCode =404){

        $response =[
            'success'=>false,
            'message'=>$message,
            'errors'=>$errors
        ];
        return response()->json($response ,$statusCode);


    }
}
