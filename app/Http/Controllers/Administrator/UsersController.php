<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests\Administrator\UserCreateRequest;
use App\Http\Requests\Administrator\UserUpdateRequest;
use App\Models\Operator;
use App\Traits\AdminImageTrait;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Services\ImageUploader\ImageUploader;

use App\Models\Role;
use App\Models\User;

class UsersController extends Controller
{
    use AdminImageTrait;

    protected $user;
    protected $role;
    protected $profile;
    protected $storageDisk;

    public function __construct(Role $role, User $user)
    {
        $this->user = $user;
        $this->role = $role;
        $this->storageDisk = config('image.storage.global');

    }

    public function getAllUsers($role = 'all')
    {
        $subSequence = ['id' => 0, 'title' => 'مدیریت کاربران'];
        $users = '';
        switch ($role) {
            case 'all' :
                $users = $this->user->getAllUsers()->orderByPagination();
                $subSequence['title'] = 'مدیریت همه کاربران';
                break;

            case 'standardUser' :
                $users = $this->user->getStandardUsers()->orderByPagination();
                $subSequence['title'] = 'مدیریت کاربران عضو';
                break;

            case 'adminUser' :
                $users = $this->user->getAdminUsers()->where('id', '<>', auth()->user()->id)->orderByPagination();
                $subSequence['title'] = 'مدیریت مدیرها';
                break;
            default:
                abort(404);
                break;
        }

        return view('v1.admin.pages.user.index', compact('subSequence', 'users'));
    }

    public function show(User $user)
    {
        $roles = $this->role->query()->whereNotIn('name', ['superAdmin'])->get();

        $user = $this->user->find($user->id);

        return view('v1.admin.pages.user.show', compact('user', 'roles'));
    }

    public function showProfile()
    {
        $user = auth()->user();
        $roles = [];

        return view('v1.admin.pages.user.show', compact('user', 'roles'));
    }


    public function create()
    {
        $roles = $this->role->query()->whereNotIn('name', ['standardUser', 'superAdmin'])->get();

        if (empty($roles->count())) {
            session()->flash('notifications', ['message'    => 'دسترسی ها خالی است. لطفا ابتدا دسترسی ها را بسازید.',
                                               'alert_type' => 'error',
            ]);

            return redirect()->route('admin.role.index');
        }

        return view('v1.admin.pages.user.create', compact('roles'));
    }

    public function store(UserCreateRequest $request)
    {
        try {

            $code = substr($request->mobile, 0, 3);
            $operator = Operator::where('code', $code)->first();

            $request->merge([
                'role_id'     => $request->role,
                'mobile_type' => $operator->type,
                'password'    => bcrypt($request->password),
            ]);

            $user = $this->user->create($request->all());


            session()->flash('notifications', ['message'    => trans('messages.crud.createdModelSuccess'),
                                               'alert_type' => 'success',
            ]);

            return redirect()->route('admin.user.all');
        } catch (\Exception $e) {
            session()->flash('notifications', ['message'    => trans('messages.crud.createdModelFail'),
                                               'alert_type' => 'error',
            ]);

            return redirect()->back();
        }
    }

    //update image in saveImage trait
    public function update(UserUpdateRequest $request, User $user)
    {


        try {

            $request->merge([
                'role_id'  => $request->role ?? $user->role_id,
                'password' => !empty($request->password) ? bcrypt($request->password) : $user->password,
            ]);
            $user->update($request->all());


            session()->flash('notifications', ['message'    => trans('messages.crud.updatedModelSuccess'),
                                               'alert_type' => 'success',
            ]);

            return redirect()->route('admin.user.show', $user->id);
        } catch (\Exception $e) {
            session()->flash('notifications', ['message'    => trans('messages.crud.updatedModelFail'),
                                               'alert_type' => 'error',
            ]);

            return redirect()->back();
        }
    }

    /* ajax type functions */
    public function doDelete(User $user)
    {
        try {
            $user->delete();
            session()->flash('notifications', ['message'    => trans('messages.crud.deletedModelSuccess'),
                                               'alert_type' => 'success',
            ]);
            return redirect()->route('admin.user.all');

        } catch (\Exception $e) {
            session()->flash('notifications', ['message'    => trans('messages.crud.updatedModelFail'),
                                               'alert_type' => 'error',
            ]);

            return redirect()->back();
        }
    }

}
