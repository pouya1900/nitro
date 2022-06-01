<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests\Administrator\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    protected $role;
    protected $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subSequence = ['id' => 0, 'title' => 'مدیریت دسترسی ها'];
        $roles = $this->role->whereNotIn('name', ['standardUser', 'superAdmin'])->orderByPagination();
        return view('v1.admin.pages.role.index', compact('subSequence', 'roles'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $permissions = $this->permission->whereNotIn('name', ['site.*', 'user.*', '*'])->get();
        return view('v1.admin.pages.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->validate($request, [
            'title' => 'unique:roles,title',
            'name' => 'unique:roles,name'
        ]);

        try{
            DB::beginTransaction();
            $role = $this->role->create($request->all());

            $role->permissions()->sync($request->permissions);
            DB::commit();
            session()->flash('notifications', ['message' => trans('messages.crud.createdModelSuccess'), 'alert_type' => 'success']);
            return redirect()->route('admin.role.show', $role->id);
        }catch(\Exception $e)
        {
            DB::rollBack();
            session()->flash('notifications', ['message' =>trans('messages.crud.createdModelFail'), 'alert_type' => 'error']);
            return redirect()->back();
        }
    }

    /**
     * @param Unit $role
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Role $role)
    {
        return view('v1.admin.pages.role.show', compact('role'));
    }

    /**
     * @param Unit $role
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $permissions = $this->permission->whereNotIn('name', ['site.*', 'user.*', '*'])->get();
        $role = $role->load('permissions');
        return view('v1.admin.pages.role.edit', compact('role', 'permissions'));
    }

    /**
     * @param Request $request
     * @param Unit $role
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoleRequest $request, Role $role)
    {
        $request->validate([
            'title' => 'unique:roles,title,' . $role->id,
            'name' => 'unique:roles,name,' . $role->id
        ]);

        try{
            DB::beginTransaction();
            $role->update($request->all());
            $role->permissions()->sync($request->permissions);
            DB::commit();
            session()->flash('notifications', ['message' => trans('messages.crud.updatedModelSuccess'), 'alert_type' => 'success']);
            return redirect()->route('admin.role.show', $role->id);
        }catch(\Exception $e)
        {
            DB::rollBack();
            session()->flash('notifications', ['message' =>trans('messages.crud.updatedModelFail'), 'alert_type' => 'error']);
            return redirect()->back();
        }
    }

    /**
     * @param Unit $role
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function doDelete($role)
    {
        try {
            if($role->users->count()){
                $failMessage = 'این دسترسی دارای کاربر است. لطفا ابتدا کاربر موردنظر را ویرایش کنید.';
                $data = [
                    'status' => 'fail',
                    'message' => $failMessage,
                    'data' => [],
                    'code' => 400
                ];
                return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
            }

            $role->permissions()->detach();
            $role->delete();
            session()->flash('notifications', ['message' => trans('messages.crud.deletedModelSuccess'), 'alert_type' => 'success']);

            $data = [
                'status' => 'success',
                'message' =>trans( 'messages.crud.deletedModelSuccess'),
                'data' => $role,
                'code' => 200
            ];

            return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            $data = [
                'status' => 'fail',
                'message' => trans('messages.crud.deletedModelFail'),
                'data' => [],
                'code' => 400
            ];

            return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
        }
    }
}
