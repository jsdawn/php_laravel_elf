<?php


namespace App\Http\Controllers\Scene;

use App\Http\Controllers\Controller;
use App\Http\Utils\ApiResponse;
use App\Http\Utils\DataFormat;
use App\Models\Scene;
use Exception;
use Illuminate\Http\Request;

class SceneController extends Controller
{

    /**
     * 情景 - 新增/编辑
     * @param Request $request
     * @return ApiResponse
     * @throws Exception
     */
    public function editScene(Request $request)
    {
        $id = $request->get('id');
        $elf_id = $request->get('elf_id');
        $title = $request->get('title');
        $image = $request->get('image');
        $brief = $request->get('brief');
        $intro = $request->get('intro');


        $collection = collect([]);
        if ($request->has('elf_id')) $collection->put('elf_id', $elf_id);
        if ($request->has('title')) $collection->put('title', $title);
        if ($request->has('image')) $collection->put('image', $image);
        if ($request->has('brief')) $collection->put('brief', $brief);
        if ($request->has('intro')) $collection->put('intro', $intro);

        $result_id = null;

        if (is_null($id)) {
            // 无id则新增
            $item = Scene::query()->create($collection->all());
            $result_id = $item->id;
        } else {
            // 有id则修改
            $item = Scene::query()->find($id);
            if (is_null($item)) {
                return ApiResponse::withBadJson('相关数据不存在');
            }

            $item->update($collection->all());
            $result_id = $item->id;
        }

        return ApiResponse::withJson(['id' => $result_id]);
    }

    /**
     * 情景 - 详情
     * @param Request $request
     * @return ApiResponse
     */
    public function getSceneDetail(Request $request)
    {
        $id = $request->get('id');

        $item = Scene::query()->find($id);
        if (is_null($item)) {
            return ApiResponse::withBadJson('相关数据不存在');
        }

        return ApiResponse::withJson($item->first());
    }

    /**
     * 情景 - 列表
     * @param Request $request
     * @return ApiResponse
     */
    public function getSceneList(Request $request)
    {
        $title = $request->get('title');

        $items = Scene::query();

        if (!is_null($title)) {
            $items = $items->where('title', 'like', "%{$title}%");
        }

        $result = DataFormat::getPageList($items, $request->get('page'), $request->get('size'));
        return ApiResponse::withJson($result);
    }

    /**
     * 精灵 - 删除
     * @param Request $request
     * @return ApiResponse
     * @throws Exception
     */
    public function deleteScene(Request $request)
    {
        $id = $request->get('id');

        $deleted_count = Scene::destroy($id);
        if ($deleted_count === 0) {
            return ApiResponse::withBadJson('相关数据不存在');
        }

        return ApiResponse::withJson(['count' => $deleted_count]);
    }
}