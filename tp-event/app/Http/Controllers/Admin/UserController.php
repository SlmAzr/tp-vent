<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index',[
            'users' => User::orderBy('name', 'asc')->get(),
            'roles' => Role::all()
        ]);
    }

    public function create(){
        $roles = Role::all();
        return view('admin.users.create',[
            'roles' => $roles
        ]);
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users|string',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:roles,name'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);
        $user->assignRole($validated['role']);

        return redirect()->route('admin.users.index')->with('success','Utilisateur crée');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.update',[
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function updateUser(Request $request,$id){
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|exists:roles,name'
        ]);
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
        $user->syncRoles($validated['role']);
        return redirect()->route('admin.users.index')->with('success','Utilisateur modifie');
    }



    public function destroy($id){
   $user = User::findOrFail($id);
        if($user) {
            $name = $user->name;
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'L\'utilisateur ' . $name . ' a bien été supprimé.');
        }
        return redirect()->route('admin.users.index')->with('error', 'L\'utilisateur concerné n\'est pas présent dans la liste des utilisateurs enregistrés.');
    }
}
