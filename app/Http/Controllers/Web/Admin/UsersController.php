<?php

namespace App\Http\Controllers\Web\Admin;

use App\Constants\Constant;
use App\Filters\UsersFilter;
use App\Helpers\Format\Date;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Date as FacadeDate;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function list()
    {
        $users = User::filter(new UsersFilter())->paginate()->withQueryString();
        $genders = Constant::getUserGendersViewer();
        $activityStatuses = Constant::getStatusesViewer();

        return view('admin.users.all', compact('users','genders','activityStatuses'));
    }

    public function create()
    {
        $activityStatuses = Constant::getStatusesViewer();
        $genders = Constant::getUserGendersViewer();
        return view('admin.users.create', compact('activityStatuses','genders'));
    }

    public function edit(User $user)
    {
        $activityStatuses = Constant::getStatusesViewer();
        $genders = Constant::getUserGendersViewer();
        return view('admin.users.edit', compact('user', 'activityStatuses','genders'));
    }

    public function store()
    {
        // validate request
        $this->validateStoreUser();

        // prepare data to insert in db
        $data = $this->getStoreUserData();

        // create new user
        $user = User::create($data);

        // redirect
        if ($user instanceof User) {
            return redirect()->route('admin.users.all')->with('success', 'ثبت کاربر با موفقیت انجام شد');
        }
        return redirect()->back();
    }

    public function update(User $user)
    {

        $this->validateUpdateForm($user);
        DB::beginTransaction();
        try {

            $data = $this->getUpdateUserData();
            $result = $user->update($data);

            DB::commit();
            if ($result) {
                return redirect()->route('admin.users.edit', $user)->with('success', 'اطلاعات کاربر با موفقیت ویرایش شد');
            }
        }catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','خطا در ویرایش اطلاعات');
        }

    }

    public function delete(User $user)
    {

        $user->delete();
        return redirect()->back();
    }

    private function validateStoreUser()
    {

        request()->validate([
            'mobile' => ['required', 'unique:users'],
            'status' => ['required', Rule::in([Constant::ACTIVE, Constant::IN_ACTIVE])],
        ], [
            'mobile.required' => "شماره موبایل خود را وارد نمائید",
            'mobile.unique' => "شماره موبایل قبلا ثبت شده است ",
            'status.in' => 'وضعیت کاربر به درستی انتخاب نشده است',
        ]);

    }
    private function validateUpdateForm(User $user)
    {
        request()->validate([
            'mobile' => ['required', Rule::unique('users', 'mobile')->ignore($user)],
        ], [
            'mobile.required' => "شماره موبایل خود را وارد نمائید",
            'mobile.unique' => "شماره موبایل قبلا ثبت شده است ",
        ]);
    }
    private function getStoreUserData(): array
    {
        $data = [
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'mobile' => request('mobile'),
            'email' => request('email'),
            'status' => request('status'),
            'gender' => request('gender')
        ];

        if (request()->hasFile('avatar')) {
            $data['avatar'] = $this->uploadFile(request()->file('avatar'), Constant::USERS_AVATAR_PATH);
        }
        return $data;
    }
    private function getUpdateUserData(): array
    {
        $data = [
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'mobile' => request('mobile'),
            'email' => request('email'),
            'status' => request('status'),
            'national_code' => request('national_code'),
            'birth_date' => !is_null(request('birth_date')) ? Date::toCarbonDateFormat(request('birth_date')):null,
            'address' => request('address'),
            'gender' => request('gender'),
            'auth_status' => request('auth_status')

        ];

        if (request()->hasFile('avatar')) {
            $data['avatar'] = $this->uploadFile(request()->file('avatar'), Constant::USERS_AVATAR_PATH);
        }
        return $data;
    }

    public function searchWithAjax(): JsonResponse
    {
        $q = request('q');

        $users = User::select('id', 'mobile as name')
            ->where('last_name', 'like', "%$q%")
            ->orWhere('first_name', 'like', "%$q%")
            ->orWhere('mobile', 'like', "%$q%")
            ->get();
        return response()->json(['data' => $users]);
    }

    public function todayLoginsList()
    {
        $users = User::where('updated_at','>',FacadeDate::yesterday())->paginate();
        return view('admin.users.today-logins',compact('users'));
    }
}
