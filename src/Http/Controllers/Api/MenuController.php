<?php

namespace Vegacms\Cms\Http\Controllers\Api;

use Vegacms\Cms\Models\Menu;
use Vegacms\Cms\Http\Resources\MenuResource;
use Vegacms\Cms\Http\Controllers\Controller;
use Vegacms\Cms\Http\Requests\MenuDataRequest;

class MenuController extends Controller
{
    /**
     * Get data for a sertain menu
     *
     * @param MenuDataRequest $request
     */
    public function getData(MenuDataRequest $request, MenuResource $resource)
    {
        $menu = Menu::find($request->menu_id);

        if($menu && $menu->status) {
            $menu->loadAllMenuItems();

            return response([
                'menu' => $resource->toArray($menu)
            ], 200);
        }

        return response([
            'message' => 'The requested menu is unavailable.'
        ], 404);
    }
}
