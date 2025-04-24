<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Display the password reset link request form.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password'); // Ensure this view exists and is correctly named
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email|exists:users,email', // Ensure the email exists in the database
        ]);

        // Attempt to send the reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Handle the response
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __('A password reset link has been sent to your email.'))
            : back()->withErrors(['email' => __('Unable to send reset link. Please try again later.')]);
    }
}