<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactUsRequest;
use App\ContactUs;

class ContactUsController extends Controller
{
    public function create(ContactUsRequest $request) {
        ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'note' => $request->note
        ]);

        return redirect('contact-us')->with('status', 'Your message sent Successfully');
    }
}
