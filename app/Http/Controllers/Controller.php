<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse(
        bool $status = true,
        int $code_reponse = 200,
        string $message = "",
        $data = []
    ) {

        $response = [
            'status' => $status,
            'code' => $code_reponse,
            'message' => $message
        ];

        if ($data) {
            $response['data'] = $data;
        }


        return response()->json($response);
    }

}
