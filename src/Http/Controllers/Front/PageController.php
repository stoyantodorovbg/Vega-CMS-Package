<?php

namespace Vegacms\Cms\Http\Controllers\Front;

use Vegacms\Cms\Models\Page;
use Vegacms\Cms\Http\Controllers\Controller;
use Vegacms\Cms\Services\Interfaces\ValidationServiceInterface;

class PageController extends Controller
{
    /**
     * Render Page data
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page($url)
    {
        if(resolve(ValidationServiceInterface::class)->validate(['url' => $url], ['url'], 'page', 'access') === true &&
            $page = Page::where('url', $url)->where('status', 1)->first()
        ) {
            return view('vegacms::front.page.renderer', [
                'pageData' => $page->getData(),
            ]);
        }

        abort(404);
    }
}
