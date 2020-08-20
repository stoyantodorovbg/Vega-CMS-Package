<?php

namespace Vegacms\Cms\Http\Controllers\Admin;

use Vegacms\Cms\Models\Locale;
use Vegacms\Cms\Http\Controllers\Controller;
use Vegacms\Cms\Http\Requests\Admin\AdminLocaleRequest;

class LocalesController extends Controller
{
    /**
     * Admin phrases locales page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('vegacms::admin.locales.index');
    }

    /**
     * Admin locales show page
     *
     * @param Locale $locale
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Locale $locale)
    {
        return view('vegacms::admin.locales.show', compact('locale'));
    }

    /**
     * Admin locales create page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('vegacms::admin.locales.create');
    }

    /**
     * Admin locales store action
     *
     * @param AdminLocaleRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(AdminLocaleRequest $request)
    {
        $locale = Locale::create($request->validated());

        return redirect()->route('admin-locales.show', $locale->getSlug())->with(compact('locale'));
    }

    /**
     * Admin locales edit page
     *
     * @param Locale $locale
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Locale $locale)
    {
        return view('vegacms::admin.locales.edit', compact('locale'));
    }

    /**
     * Admin locales update action
     *
     * @param Locale $locale
     * @param AdminLocaleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Locale $locale, AdminLocaleRequest $request)
    {
        $locale->update($request->validated());

        return redirect()->back();
    }
}
