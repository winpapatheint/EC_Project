<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        if (!empty(Auth::user()->role)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->intended(RouteServiceProvider::ADMIN);
            } else if (Auth::user()->role == 'hcompany') {
                return redirect()->intended(RouteServiceProvider::HCOMPANY);
            } else if (Auth::user()->role == 'host') {
                return redirect()->intended(RouteServiceProvider::HOST);
            } else {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }

        return view('front-end.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {

        $request->authenticate();

        $request->session()->regenerate();

        // print_r(Auth::user()->role);die();
        if (Auth::user()->role == 'admin') {

            return redirect()->intended(RouteServiceProvider::ADMIN);
        }

        else if (Auth::user()->role == 'seller') {

            return redirect()->intended(RouteServiceProvider::HCOMPANY);
        } else if (Auth::user()->role == 'host') {
            return redirect()->intended(RouteServiceProvider::HOST);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        dd(Auth::user()->role);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
