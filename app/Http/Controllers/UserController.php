<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $data = User::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        } else {
            $data = User::paginate(10);
        }
        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:'.User::class,
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        // dd($user);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password_old' => [
                'nullable',
                function ($attribute, $value, $fail) use ($user) {
                    if ($value && !Hash::check($value, $user->password)) {
                        $fail('Password lama tidak sesuai.');
                    }
                },
            ],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->name = $request->name;
        $user->slug = Str::slug($request->name);
        $user->email = $request->email;

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Cek jika user yang akan dihapus adalah user yang sedang login
        if ($user->id === Auth::id()) {
            throw ValidationException::withMessages([
                'user' => ['Anda tidak dapat menghapus akun Anda sendiri.'],
            ]);
        }

        // Cek jika user yang akan dihapus adalah user pertama
        $firstUserId = User::orderBy('id')->value('id');
        if ($user->id === $firstUserId) {
            throw ValidationException::withMessages([
                'user' => ['Pengguna pertama(Admin) tidak dapat dihapus.'],
            ]);
        }

        $user->delete();

        return back();
    }
}
