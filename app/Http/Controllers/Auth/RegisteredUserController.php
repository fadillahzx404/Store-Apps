<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render("auth/register");
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:" . User::class,
            "password" => ["required", "confirmed", Rules\Password::defaults()],
            'store_name' => ['nullable', 'string', 'max:255'],
            'categories_id' => ['nullable', 'integer', 'exists:categories,id'],
            'is_store_open' => ['required'],
        ]);

        $image_path = $data->file('photo_profile')->store('assets/profile', 'public');

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            'store_name' => isset($request->store_name) ? $request->store_name : '',
            'categories_id' => isset($request->categories_id) ? $request->categories_id : NULL,
            'store_status' => $request->is_store_open ? 1 : 0,
            "photo_profile" => $image_path
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    public function success()
    {
        return view('auth.success');
    }
    public function check(Request $request)
    {
        return User::where('email', $request->email)->count() > 0 ? 'Unavailable' :"Available" ;
    }
}
