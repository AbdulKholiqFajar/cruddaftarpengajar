<?php

namespace App\Http\Controllers\UserManagement;

use App\Models\User;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View|Factory
    {
        $users  = User::get();
        $roles  = Role::get();

        return view('userManagement.user.index', compact('users','roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse|Response
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $roleIds = $data['role_id'];
            $data['password'] = bcrypt($request->password);
            $users = User::create($data);
            
            if(!empty($users['id'])){
                $roles = Role::whereIn('id', $roleIds)->get();
                $users->assignRole($roles);
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user): JsonResponse
    {
        if(!empty($user)){
            $roles = Role::get();
            $idRole = [];
            if($user->roles){
                foreach($user->roles as $user_role){
                    $idRole[] = $user_role->id;
                }
            }
            if($roles){
                foreach($roles as $key => $role){
                    $roles[$key]->selected = '';
                    if(in_array($role->id, $idRole)){
                        $roles[$key]->selected = 'selected';
                    }
                }
            }
            return response()->json([
                'status'  => true,
                'data'    => $user,
                'roles'   => $roles,
                'message' => 'Data berhasil diambil.',
            ], JsonResponse::HTTP_OK);
        }else{
            return response()->json([
                'message' => 'Data Tidak Ada.',
                'data'    => [],
                'roles'   => [],
                'status' => false,
            ], JsonResponse::HTTP_NOT_FOUND);
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user): RedirectResponse|Response
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $roleIds = $data['role_id'];
            $data['password'] = bcrypt($request->password);
            if($data['password'] == $user->password){
                unset($data['password']);
            }else{
                $data['password'] = $data['password'];
            }
            $user->update($data);
            DB::table('model_has_roles')->where('model_id',$user->id)->delete();
            
            if(!empty($user['id'])){
                $roles = Role::whereIn('id', $roleIds)->get();
                $user->assignRole($roles);
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user): JsonResponse
    {
        DB::beginTransaction();
        try {
           
            if(!empty($user)){
                $user->delete();
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Data Tidak Ada.',
                'data'    => [],
                'status' => false,
            ], JsonResponse::HTTP_NOT_FOUND);
        }
        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil diambil.',
        ], JsonResponse::HTTP_OK);
    }
}
