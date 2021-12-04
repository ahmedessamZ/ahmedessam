<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function __invoke(Newsletter $newsletter){

        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->subscribe(request('email'));
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'this email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/')->with('success', 'Your are now signed up for our newsletter !');
    }
}
