<?php

namespace App\Http\Controllers\UserManagement;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View|Factory
    {
        $roles  = Role::get();
        $permissions = Permission::get();
        return view('userManagement.role.index', compact('roles','permissions'));

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
            $roles = Role::create(['name' => $data['name']]);
            if(!empty($roles['id'])){
                if(!empty($data['permission_id'])){
                    $permissions = Permission::whereIn('id', $data['permission_id'])->get();
                    $roles->syncPermissions($permissions);
                }
                DB::commit();
            }

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('role.index')->with('success', 'Data berhasil');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role): JsonResponse
    {
        if(!empty($role)){
            $idPermission = [];
            if($role->permissions){
                foreach($role->permissions as $role_permission){
                    $idPermission[] = $role_permission->id;
                }
            }
            $permissions = Permission::get();

            if($permissions){
                foreach($permissions as $key => $permission){
                    $permissions[$key]->checked = '-';
                    if(in_array($permission->id, $idPermission)){
                        $permissions[$key]->checked = 'checked';
                    }
                }
            }
            return response()->json([
                'status'  => true,
                'data'    => $role,
                'permissions' => $permissions,
                'message' => 'Data berhasil diambil.',
            ], JsonResponse::HTTP_OK);
        }else{
            return response()->json([
                'message' => 'Data Tidak Ada.',
                'data'    => [],
                'roles'   => [],
                'permissions' => [],
                'status' => false,
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role): RedirectResponse|Response
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $role->update($data);

            if(!empty($data['permission_id'])){
                $permissions = Permission::whereIn('id', $data['permission_id'])->get();
                $role->syncPermissions($permissions);
            }
            DB::commit();
            

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('role.index')->with('success', 'Data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role): JsonResponse
    {
        DB::beginTransaction();
        try {
           
            if(!empty($role)){
                $role->delete();
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Data Tidak Ada.',
                'status' => false,
            ], JsonResponse::HTTP_NOT_FOUND);
        }
        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil diambil.',
        ], JsonResponse::HTTP_OK);
    }
}
