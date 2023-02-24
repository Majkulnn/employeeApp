<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\RegistrationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::all();

        return inertia('Users/index',['users' => $users]);
    }

    public function create()
    {
        return inertia('Users/create');
    }

    public function store(Request $request, RegistrationService $service)
    {
        $request->validate([
            'lastName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
        ]);

        $password = Str::password(12);

        $user = User::create([
            'username' => $request->firstName.$request->lastName,
            'last_name' => $request->lastName,
            'first_name' => $request->firstName,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        event(new Registered($user));

        return redirect(route('users.index'))->with('success','User successfully created');
    }

    public function edit(int $id)
    {
        $user = User::query()->findOrFail($id)->get();

        return inertia('Users/edit',['user' => $user]);
    }

    public function update()
    {
        $users = User::all();

        return inertia('Users/index',['users' => $users]);
    }

    public function destroy(int $id)
    {
        User::destroy($id);

        return redirect(route('users.index'));
    }
}
