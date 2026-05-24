<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->get();

        return view('pages.services', compact('services'));
    }
}
