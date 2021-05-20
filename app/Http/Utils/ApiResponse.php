<?php


namespace App\Http\Utils;


use Illuminate\Http\Response;

class ApiResponse extends Response
{
    protected $headerContentType = "application/json";

    public static function withJson($data = null)
    {
        $response = new static();
        $response->withHeaders([
            'Content-Type' => 'application/json'
        ]);
        $response->setContent(json_encode([
            'status' => self::HTTP_OK,
            'msg' => 'success',
            'data' => $data
        ]));

        return $response;
    }

    public static function withBadJson($msg)
    {
        $response = new static();
        $response->withHeaders([
            'Content-Type' => 'application/json'
        ]);
        $response->setContent(json_encode([
            'status' => self::HTTP_BAD_REQUEST,
            'msg' => $msg,
            'data' => null
        ]));

        return $response;
    }

    function app_cal_offset($size = 20, $page = null, $pageKey = 'page')
    {
        if (!$page) {
            $page = \Illuminate\Support\Facades\Input::get($pageKey, 1);
        }
        return (int)($page - 1) * $size;
    }
}