<?php


namespace App\Http\Utils;


use Illuminate\Database\Eloquent\Builder;

class DataFormat
{
    // 将Builder分页；$page=null->不分页
    public static function getPageList(Builder $items, $page, $size)
    {
        if (!is_null($page)) {
            $paginate = $items->paginate($size ? $size : 10);
            $result = [
                "list" => $paginate->items(),
                "page" => $paginate->currentPage(),
                "total" => $paginate->total()
            ];
        } else {
            $result = $items->get();
        }
        return $result;
    }

}