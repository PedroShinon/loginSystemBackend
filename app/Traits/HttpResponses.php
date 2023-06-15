<?php

namespace App\Traits;

trait HttpResponses {
    protected function success($data,$message = null, $code = 200){
        return response()->json([
            'status' => 'Request was succesful.',
            'message' => $message,
            'data' => $data
        ], $code);

    }

    protected function failed($data,$message = null, $code){
        return response()->json([
            'status' => 'Error was ocurred...',
            'message' => $message,
            'data' => $data
        ], $code);

    }
}