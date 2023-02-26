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
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(Request $request): Response
    {
        if ($request->get('search')){
            $searchValue = $request->get('search');
            $users = User::where('username','like','%'.$searchValue.'%')
                ->orWhere('first_name','like','%'.$searchValue.'%')
                ->orWhere('last_name','like','%'.$searchValue.'%')
                ->get();
        }else $users = User::all();

        return inertia('Users/index',['users' => $users]);
    }

    public function create(): Response
    {
        return inertia('Users/create');
    }

    public function store(Request $request): RedirectResponse
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

    public function edit(int $id): Response
    {
        $user = User::findOrFail($id);

        return inertia('Users/edit',['user' => $user]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class.',email,'.$id.',id',
        ]);
        $user = User::updateOrCreate(
            ['id' => $id],
            [
                'username' => $request->username,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
            ]
        );

        return redirect(route('users.index'));
    }

    public function destroy(int $id): RedirectResponse
    {
        User::destroy($id);

        return redirect(route('users.index'));
    }
}
