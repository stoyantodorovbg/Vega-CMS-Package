<?php

namespace Vegacms\Cms\Http\Controllers\Api;

use Vegacms\Cms\Models\Locale;
use Illuminate\Http\JsonResponse;
use Vegacms\Cms\Http\Controllers\Controller;
use Vegacms\Cms\Services\Interfaces\LocaleServiceInterface;
use Vegacms\Cms\Services\Interfaces\ValidationServiceInterface;

class LocalesController extends Controller
{
    /**
     * Set a site locale
     *
     * @param ValidationServiceInterface $validationService
     * @param LocaleServiceInterface $localeService
     * @return JsonResponse
     */
    public function setLocale(
        ValidationServiceInterface $validationService,
        LocaleServiceInterface $localeService
    ): JsonResponse {
        $validationData = $validationService->validate(request()->all(), ['code'], 'locale', 'set');

        if ($validationData === true) {
            $oldLocaleCode = app()->getLocale();
            $localeService->setSelectedLocale(request()->code);

            return response()->json([
                    'success' => true,
                    'message' => 'The site locale is changed successfully.',
                    'useUrlLocalization' => config('cms.locales.codes')[0] ? true : false,
                    'oldLocaleCode' => $oldLocaleCode,
                ]);
        }

        return response()->json([
            'error' => $validationData
        ], 302);
    }

    /**
     * Get active locales
     *
     * @return JsonResponse
     */
    public function getActiveLocales()
    {
        $locales = Locale::where('status', 1)->get();
        $currentLocaleCode = app()->getLocale();

        $currentLocale = $locales->where('code', $currentLocaleCode);
        $locales = $locales->filter(function ($item) use($currentLocaleCode) {
            return $item->code !==$currentLocaleCode;
        });

        $locales->prepend($currentLocale->first());

        return response()->json([
            'active_locales' => $locales,
        ]);
    }
}
