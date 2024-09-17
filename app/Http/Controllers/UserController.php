<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required'],
            'address' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        $position = Position::create([
            'position_name' => $request->position_name
        ]);

        $profile = UserProfile::create([
            'position_id' => $position->id,
            'nip' => $request->nip,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        $user = User::create([
            'profiles_id' => $profile->id,
            'nip' => $profile->nip,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $profile->phone,
            'address' => $profile->address,
            'password' => Hash::make($request->password),
        ]);

        session()->flash('success', 'User created successfully');
        return redirect()->route('user.index');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nip' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$user->id],
            'phone' => ['required'],
            'address' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        $position = Position::create([
            'position_name' => $request->position_name
        ]);

        $profile = UserProfile::create([
            'position_id' => $position->id,
            'nip' => $request->nip,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        $user->update([
            'profiles_id' => $profile->id,
            'nip' => $profile->nip,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $profile->phone,
            'address' => $profile->address,
            'password' =>$request->password ? Hash::make($request->password) : $user->password,
        ]);

        session()->flash('success', 'User updated successfully');
        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('success', 'User deleted successfully');
        return redirect()->route('user.index');
    }
}
