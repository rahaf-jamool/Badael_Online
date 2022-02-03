<?php

namespace App\Service\User;

use App\Http\Requests\User\UserRequest;
use App\Manager\User\UserManager;
use App\Models\User\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserService
{
    // private $userManager;
    // public function __construct(UserManager $userManager)
    // {
    //     $this->userManager=$userManager;
    // }
    public function index()
    {
        $users = User::latest()->get();
        $users->transform(function($user){
            $user->role = $user->roles()->first();
            return $user;
        });
        return view('admin.user.index',[
            'user' => $users,
        ]);

        // return $this->userManager->index();
    }

    public function create(){
        $roles = Role::all();
       return view ('admin.user.create',compact('roles'));
        // return $this->userManager->create();
    }

    public function store(Request $request){
        // return $request->all();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $id=$user->id;

        if ($request->has('roles')) {
                $role = User::find($id);
                $role->roles()->syncWithoutDetaching($request->get('roles'));
            }
            
        if ($user->save()) {
            return redirect()->route('admin.user')->with('success', 'Data added successfully');
        }else {

            return redirect()->route('admin.user.create')->with('error', 'Data failed to add');

        }
        // return $this->userManager->store($request);
    }

    public function show($id){
        // return $this->userManager->show($id);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.user.edit',[
            'user' => $user
        ]);
        // return $this->userManager->edit($id);
    }

    public function update(UserRequest $request, $id){
        try{
            // return $request->all();
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;

            return redirect()->route('admin.user')->with('success', 'Data updated successfully');
        }catch(\Exception $ex){
            return $ex->getMessage();
            return redirect()->route('admin.user.edit')->with('error', 'Data failed to update');
        }
        // return $this->userManager->update($request, $id);
    }

    public function changepassword(Request $request, $id){
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);

        if ( $user->save()) {

            return redirect()->route('admin.user')->with('success', 'Password updated successfully');

           } else {

            return redirect()->route('admin.user')->with('error', 'Password failed to update');

           }
        // return $this->userManager->changepassword($id,$request);
    }

    public function destroy($id){
        // return $this->userManager->destroy($id);
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.user')->with('success', 'Data deleted successfully');
    }
}
