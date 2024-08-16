<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View|Factory
    {
        $permissions = Permission::get();
        return view('userManagement.permission.index', compact('permissions'));
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
            Permission::create(['name' => $data['name']]);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('permission.index')->with('success', 'Data berhasil');


    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        if(!empty($permission)){
            return response()->json([
                'status'  => true,
                'data'    => $permission,
                'message' => 'Data berhasil diambil.',
            ], JsonResponse::HTTP_OK);
        }else{
            return response()->json([
                'message' => 'Data Tidak Ada.',
                'data'    => [],
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
    public function update(Request $request, Permission $permission): RedirectResponse|Response
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $permission->update($data);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('permission.index')->with('success', 'Data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        DB::beginTransaction();
        try {
           
            if(!empty($permission)){
                $permission->delete();
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
