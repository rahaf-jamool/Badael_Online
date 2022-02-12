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
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function dashboard(){
        return $this->user::count();
    }

    public function index()
    {
        return $this->user->latest()->get();
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $user= $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password)
        ]);

        DB::commit();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->user->findOrFail($id);
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
