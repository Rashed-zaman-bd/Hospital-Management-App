<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = User::query();

    // Filter by user type if selected
    if ($request->has('user_type') && $request->user_type != '') {
        $query->where('user_type', $request->user_type);
    }

    $users = $query->latest()->get();

    // Get all unique user types for the dropdown
    $userTypes = User::select('user_type')->distinct()->pluck('user_type');

    return view('backend.pages.admin.admin_show', compact('users', 'userTypes'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'user_type' => 'required|string',
        'password' => 'required|string|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'user_type' => $request->user_type,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('admin.user')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $id)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$id,
        'user_type' => 'required|in:admin,user',
    ]);

    $user = User::findOrFail($id);
    $user->update($request->only('name', 'email', 'user_type'));

    return redirect()->route('admin.user')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $request)
    {
        User::findOrFail($request)->delete();
        sweetalert()->success('User deleted successfully');
        return redirect()->back();
    }

     public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
