<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Service\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\GeneralTrait;

class UserController extends Controller
{
    use GeneralTrait;
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

            return $this->SuccessMessage('admin.user',' added' );

        }catch(\Exception $ex){
            DB::rollback();
            return $this->ErrorMessage('admin.user.create', $ex->getMessage());
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
            return $this->SuccessMessage('admin.user',' updated' );
        }catch(\Exception $ex){
            DB::rollback();
            return $this->ErrorMessage('admin.user.edit', $ex->getMessage());
        }
    }

    public function changepassword(Request $request, $id){
        try{
            $this->userService->changepassword($request,$id);
            return $this->SuccessMessage('admin.user',' updated' );
        }catch(\Exception $ex){
            DB::rollback();
            return $this->ErrorMessage('admin.user', $ex->getMessage());
        }
    }

    public function destroy($id){
        try{
            $this->userService->destroy($id);
            return $this->SuccessMessage('admin.user',' deleted' );
        }catch(\Exception $ex){
            DB::rollback();
            return $this->ErrorMessage('admin.user', $ex->getMessage());
        }
    }
}
