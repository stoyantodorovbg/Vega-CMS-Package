<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Http\Resources\MenuResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuDataRequest;

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
