<?php

namespace App\Http\Controllers;

use App\Models\ContactAlert;
use App\Models\ContactSupport;
use App\Models\SiteSetting;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __invoke(): View
    {
        $supports = ContactSupport::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $alerts = ContactAlert::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('public.kontak', [
            'subtitle' => SiteSetting::getValue('contact.subtitle'),
            'address' => SiteSetting::getValue('contact.address'),
            'phone' => SiteSetting::getValue('contact.phone'),
            'email' => SiteSetting::getValue('contact.email'),
            'supports' => $supports,
            'alerts' => $alerts,
        ]);
    }
}

