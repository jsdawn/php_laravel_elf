<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Utils\ApiResponse;
use Illuminate\Http\Request;


class CommonController extends Controller
{

    /**
     * 用于调试使用
     * @param Request $request
     * @return ApiResponse
     */
    public function test(Request $request)
    {

        return ApiResponse::withJson($_SERVER['HTTP_HOST'] . '/storage/');

    }

    /**
     * 上传文件
     * @param Request $request
     * @return ApiResponse
     */
    public function fileUpload(Request $request)
    {
        $path = $request
            ->file('file')
            ->store('files', 'public');

        return ApiResponse::withJson($_SERVER['HTTP_HOST'] . '/storage/' . $path);
    }
}