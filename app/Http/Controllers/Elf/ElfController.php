<?php


namespace App\Http\Controllers\Elf;

use App\Http\Controllers\Controller;
use App\Http\Utils\ApiResponse;
use App\Http\Utils\DataFormat;
use Exception;
use Illuminate\Http\Request;
use App\Models\Elf;

class ElfController extends Controller
{
    /**
     * 精灵 - 新增/编辑
     * @param Request $request
     * @return ApiResponse
     */
    public function editElf(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $avatar = $request->get('avatar');
        $gender = $request->get('gender');
        $brief = $request->get('brief');
        $role_ids = $request->get('role_ids');


        $collection = collect([]);
        if ($request->has('name')) $collection->put('name', $name);
        if ($request->has('avatar')) $collection->put('avatar', $avatar);
        if ($request->has('gender')) $collection->put('gender', $gender);
        if ($request->has('brief')) $collection->put('brief', $brief);

        $result_id = null;

        if (is_null($id)) {
            // 无id则新增
            $item = Elf::query()->create($collection->all());
        } else {
            // 有id则修改
            $item = Elf::query()->find($id);
            if (is_null($item)) {
                return ApiResponse::withBadJson('相关数据不存在');
            }

            $item->update($collection->all());
        }

        // 设置角色
        if ($request->has('role_ids')) {
            if (is_array($role_ids) && count($role_ids) > 0) {
                $item->roles()->sync($role_ids);   // 同步角色到ids
            } else {
                $item->roles()->detach(); // 移除当前角色
            }
        }

        $result_id = $item->id;
        return ApiResponse::withJson(['id' => $result_id]);
    }

    /**
     * 精灵 - 详情
     * @param Request $request
     * @return ApiResponse
     */
    public function getElfDetail(Request $request)
    {
        $id = $request->get('id');

        $item = Elf::query()->find($id);
        if (is_null($item)) {
            return ApiResponse::withBadJson('相关数据不存在');
        }

        $role_list = [];
        foreach ($item->roles as $role) {
            array_push($role_list, ['id' => $role->id, 'name' => $role->name]);
        }

        $result = $item->first();
        $result['roles'] = $role_list;

        return ApiResponse::withJson($result);
    }

    /**
     * 精灵 - 列表
     * @param Request $request
     * @return ApiResponse
     */
    public function getElfList(Request $request)
    {
        $name = $request->get('name');
        $gender = $request->get('gender');

        $items = Elf::query();

        if (!is_null($name)) {
            $items = $items->where('name', 'like', "%{$name}%");
        }
        if (!is_null($gender)) {
            $items = $items->where('gender', $gender);
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
    public function deleteElf(Request $request)
    {
        $id = $request->get('id');

        $deleted_count = Elf::destroy($id);
        if ($deleted_count === 0) {
            return ApiResponse::withBadJson('相关数据不存在');
        }

        return ApiResponse::withJson(['count' => $deleted_count]);
    }
}