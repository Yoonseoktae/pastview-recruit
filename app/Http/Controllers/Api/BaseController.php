<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * 페이지네이션 포함 성공 응답
     * @param   object    $data
     * @param   string    $message
     * @return  object
     */
    protected function paginated($data, $message = 'success')
    {
        return response()->json([
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
        $result = ['message' => $message];
    
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
            'message' => $message,
        ];

        if ($errors) {
            $result['errors'] = $errors;
        }

        return response()->json($result, $code);
    }

    /**
     * 404 에러
     */
    protected function notFound($message = '리소스를 찾을 수 없습니다.')
    {
        return $this->error($message, 404);
    }


}