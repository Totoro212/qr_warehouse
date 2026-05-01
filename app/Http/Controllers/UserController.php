<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:admin,manager,warehouse',
        ]);

        if ($user->id === auth()->id() && $validated['role'] !== 'admin') {
            return back()->with('error', 'Нельзя снять роль админа у себя');
        }

        $user->update(['role' => $validated['role']]);

        return back()->with('success', "Роль пользователя {$user->name} изменена на {$validated['role']}");
    }

    public function resetPassword(User $user)
    {
        $newPassword = Str::random(10);

        $user->update(['password' => $newPassword]);

        return back()->with('success', "Пароль для пользователя {$user->name} успешно сброшен! Новый пароль: {$newPassword}");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Вы не можете удалить свой собственный аккаунт');
        }

        if ($user->stockMovements()->exists()) {
            return back()->with('error', "Невозможно удалить {$user->name}, так как у него есть история складских операций.");
        }

        $userName = $user->name;
        $user->delete();

        return back()->with('success', "Пользователь {$userName} успешно удален из системы");
    }
}
