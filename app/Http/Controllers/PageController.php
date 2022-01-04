<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {
        return Inertia::render('Home');
    }

    public function projects()
    {
        return Inertia::render('Projects');
    }

    public function contact()
    {
        return Inertia::render('Contact');
    }

    public function contactFormSubmit(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'start' => 'required',
            'type' => 'required',
            'remote' => 'required',
            'description' => 'required',
        ]);

        //Mail::to(config('mail.to.address'))->send(new ContactFormSubmitted($request));

        return response()->json(null, 200);

    }
}
