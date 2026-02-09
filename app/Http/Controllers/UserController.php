<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user_access', ['only' => ['index', 'show']]);
        $this->middleware('permission:user_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user_delete', ['only' => ['destroy']]);
    }

public function index(Request $request)
{
    $query = User::query()->orderByDesc('updated_at');

    // 🔍 Search filter
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    // 🧩 Role filter
    if ($request->filled('role')) {
        $query->where('role', $request->input('role'));
    }

    $users = $query->paginate(10)->appends($request->query());

    // 🧭 Roles for dropdown
    $roles = ['admin', 'owner', 'user']; // lowercase to match DB values

    return view('admin.users.index', compact('users', 'roles'));
} 

public function show($id)
{
    $user = User::with(['houses', 'cars'])->findOrFail($id);

    return view('admin.users.show', compact('user'));
}



    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email',
        'phone' => [
            'required',
            'regex:/^(?:\+2519\d{8}|09\d{8})$/', // Ethiopian format
            'unique:users,phone',
        ],
        'password' => 'required|string|min:6|confirmed',
        'role' => 'required|exists:roles,id',
    ]);

    $role = Role::findOrFail($request->role);

    // ✅ Create user and save phone + role column
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;   // <-- was missing
    $user->password = Hash::make($request->password);
    $user->role = $role->name;        // <-- keep users.role column in sync
    $user->save();

    // ✅ Attach role to Spatie pivot
    $user->assignRole($role->name);

    // Optional: log action
    Log::create([
        'action' => "Created new user: {$user->name}",
        'user_id' => Auth::id(),
    ]);

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User created successfully.');
}



    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email,' . $id,
        'phone' => [
            'required',
            'regex:/^(?:\+2519\d{8}|09\d{8})$/',
            'unique:users,phone,' . $id,
        ],
        'password' => 'nullable|string|min:6|confirmed',
        'role' => 'required|exists:roles,id',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Update role in users table as well
    $role = Role::findOrFail($request->role);
    $user->role = $role->name; 

    $user->save();

    // Update Spatie role pivot
    $user->syncRoles([$role->name]);

    Log::create([
        'action' => "Updated user: {$user->name}",
        'user_id' => Auth::id(),
    ]);

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User updated successfully.');
}


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Log::create([
            'action' => "Deleted user: {$user->name}",
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

public function toggleRole($id)
{
    $user = User::findOrFail($id);

    // Example toggle between Admin and Staff
    if ($user->hasRole('Admin')) {
        $user->syncRoles(['Staff']);
    } else {
        $user->syncRoles(['Admin']);
    }

    Log::create([
        'action' => "Toggled role for user: {$user->name}",
        'user_id' => Auth::id(),
    ]);

    return redirect()->back()->with('success', 'User role updated successfully.');
}

public function owners()
{
    // Get all users with role 'owner'
    $owners = User::where('role', 'owner')->get();

    return view('admin.users.owners', compact('owners'));
}

}
