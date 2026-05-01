<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    public function create(): View
    {
        return view('auth.register');
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'Имя обязательно для заполнения.',
            'name.max' => 'Имя не должно быть длиннее 255 символов.',
            
            'email.required' => 'Email обязателен для заполнения.',
            'email.email' => 'Пожалуйста, введите корректный email адрес.',
            'email.unique' => 'Этот email уже занят.',
            'email.max' => 'Email не должен быть длиннее 255 символов.',
            
            'password.required' => 'Пароль обязателен для заполнения.',
            'password.confirmed' => 'Введенные пароли не совпадают.',
            'password.min' => 'Пароль должен состоять минимум из 8 символов.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
