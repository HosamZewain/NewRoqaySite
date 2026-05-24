<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function about()
    {
        $page = Page::where(function ($q) {
                $q->where('slug_ar', 'about')->orWhere('slug_en', 'about');
            })
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.page', compact('page'));
    }
}
