<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('loginregister.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->all();
        $validated['pass'] = Hash::make($validated['pass']);
        
        User::create($validated);
        
        return redirect('/login');
    }
}