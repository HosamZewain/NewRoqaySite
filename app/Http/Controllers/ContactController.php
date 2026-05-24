<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Lead;
use App\Models\Product;
use App\Models\SiteSetting;

class ContactController extends Controller
{
    public function index()
    {
        $products = Product::active()->ordered()->get();
        $locale = app()->getLocale();

        return view('pages.contact', compact('products', 'locale'));
    }

    public function store(ContactFormRequest $request)
    {
        // Honeypot check - if the hidden field is filled, it's a bot
        if ($request->filled('website_url')) {
            // Silently reject spam
            $locale = app()->getLocale();
            $message = $locale === 'ar'
                ? 'تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.'
                : 'Your message has been sent successfully. We will contact you soon.';

            return back()->with('success', $message);
        }

        Lead::create([
            'name' => $request->validated('name'),
            'company_name' => $request->validated('company_name'),
            'phone' => $request->validated('phone'),
            'email' => $request->validated('email'),
            'business_type' => $request->validated('business_type'),
            'interested_product' => $request->validated('interested_product'),
            'message' => $request->validated('message'),
            'source' => 'contact_form',
            'status' => 'new',
        ]);

        $locale = app()->getLocale();
        $message = $locale === 'ar'
            ? 'تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.'
            : 'Your message has been sent successfully. We will contact you soon.';

        return back()->with('success', $message);
    }
}
