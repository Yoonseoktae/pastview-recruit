<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * 페이지네이션 정보
     * @param   object    $data
     * @param   string    $message
     * @return  object
     */
    protected function paginated($data, $message = 'success')
    {
        return response()->json([
            'result' => true,
            'message' => $message,
            'data' => $data->items(),
            'pagination' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem(),
            ]
        ]);
    }

    /**
     * 공통 성공 Response
     * @param   array   $data
     * @param   string  $message
     * @param   int     $code
     * @return  object
     */
    protected function success($data = null, $message = 'success', $code = 200)
    {
        $result = [
            'result' => true,
            'message' => $message,
        ];

        if ($data) {
            $result['data'] = $data;
        }

        return response()->json($result, $code);
    }

    /**
     * 공통 에러 Response
     * @param   string  $message
     * @param   int     $code
     * @param   array   $errors
     * @return  object
     */
    protected function error($message = 'error', $code = 400, $errors = null)
    {
        $result = [
            'result' => false,
            'message' => $message,
        ];

        if ($errors) {
            $result['errors'] = $errors;
        }

        return response()->json($result, $code);
    }


}