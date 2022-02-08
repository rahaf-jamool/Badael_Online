<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface{

    private $user;
    private $role;
    public function __construct(User $user,Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $users = $this->user->latest()->get();
        $users->transform(function($user){
            $user->role = $user->roles()->first();
            return $user;
        });
        return $users;
    }

    public function create()
    {
        return $this->role->all();
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $user= $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password)
        ]);

        if ($request->has('roles')) {
            $role = $this->user->find($user->id);
            $role->roles()->syncWithoutDetaching($request->get('roles'));
        }

        DB::commit();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = $this->user->findOrFail($id);
        $roles = $this->role->all();
        return view('admin.user.edit',[
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, $id)
    {
        $users= $this->user->find($id);

        DB::beginTransaction();

        $users->where('users.id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password)
        ]);

        if ($request->has('roles')) {
            $role = $this->user->find($users->id);
            $role->roles()->syncWithoutDetaching($request->get('roles'));
        }

        DB::commit();
    }

    public function changepassword(Request $request, $id)
    {
        $user = $this->user->findOrFail($id);
        $user->password = Hash::make($request->password);
    }

    public function destroy($id)
    {
        $user = $this->user->findOrFail($id);
        $user->delete();
    }
}
