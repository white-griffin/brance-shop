@extends('layouts.admin.auth')

@section('content')
    <div class="w-lg-500px p-10 p-lg-15 mx-auto" dir="rtl">
        <!--begin::Form-->
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
        <form action="{{route('admin.auth.login.store')}}" class="form w-100" method="post">
        @csrf
        <!--begin::Heading-->
            <div class="text-center mb-10">
                <!--begin::Title-->
                <h1 class="text-dark mb-3">ورود به پنل مدیریت</h1>
                <!--end::Title-->
            </div>
            <!--begin::Heading-->
            <!--begin::Input group-->
            <div class="fv-row mb-10">
                <!--begin::Label-->
                <label class="form-label fs-6 fw-bolder text-dark text-right">نام کاربری</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control-lg form-control-solid" type="text" name="username"
                       autocomplete="off" placeholder="نام کاربری"/>
                @error('username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-10">
                <!--begin::Wrapper-->
                <div class="d-flex flex-stack mb-2">
                    <!--begin::Label-->
                    <label class="form-label fw-bolder text-dark fs-6 mb-0">رمز عبور</label>

                </div>
                <!--end::Wrapper-->
                <!--begin::Input-->
                <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                       autocomplete="off" placeholder="رمز عبور"/>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Actions-->
            <div class="text-center">
                <!--begin::Submit button-->
                <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                    <span class="indicator-label">ورود</span>
                </button>
                <!--end::Submit button-->
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>

@endsection
