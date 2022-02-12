<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
// use App\Http\Requests\User\UserRequest;
use App\Service\User\UserService;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService=$userService;
    }

    public function dashboard(){
        $admin = $this->userService->dashboard();
        return view ('admin.dashboard', compact('admin'));
    }

    public function index()
    {
        $users = $this->userService->index();

        return view('admin.user.index',[
            'user' => $users,
        ]);
    }

    public function create(){
        $roles = $this->userService->create();
        return view ('admin.user.create',compact('roles'));

    }

    public function store(Request $request){
        try{
            $this->userService->store($request);

            return redirect()->route('admin.user')->with('success', 'Data added successfully');

        }catch(\Exception $ex){
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.user.create')->with('error', 'Data failed to add');
        }
    }

    public function show($id){
        return $this->userService->show($id);
    }

    public function edit($id){
        $user = $this->userService->edit($id);
        return view('admin.user.edit',[
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id){
        try{
            $this->userService->update($request, $id);

            return redirect()->route('admin.user')->with('success', 'Data updated successfully');
        }catch(\Exception $ex){
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.user.edit')->with('error', 'Data failed to update');
        }
    }

    public function changepassword(Request $request, $id){
        try{
            $this->userService->changepassword($request,$id);
            return redirect()->route('admin.user')->with('success', 'Password updated successfully');

        }catch(\Exception $ex){
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.user')->with('error', 'Password failed to update');
        }
    }

    public function destroy($id){
        try{
            $this->userService->destroy($id);
            return redirect()->route('admin.user')->with('success', 'Data deleted successfully');

        }catch(\Exception $ex){
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.user')->with('error', 'Data deleted failed');
        }
    }
}
