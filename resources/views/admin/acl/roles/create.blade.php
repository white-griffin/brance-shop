@extends('layouts.admin.admin')
@section('title',' مدیریت  سطوح دسترسی ')
@section('pageTitle','   مدیریت نقش ها ')
@section('pageTitleSingle','    ثبت نقش ')
@section('content')
<div class="card" data-select2-id="select2-data-131-rhmf">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            ثبت نقش  جدید
        </h3>
        <div class="card-toolbar">

            <a href="{{ route('admin.roles.all') }}" class="btn btn-sm btn-light-success">
                بازگشت
            </a>
        </div>
    </div>
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <form method="POST" action="{{ route('admin.roles.store') }}">
            @csrf
            <div class="card">
                <div class="card-body" style="">
                    <div class="form-group row">
                        <div class="col-lg-6 ">
                            <label>عنوان   : </label>
                            <div class="input-group date ">
                                <input type="text" name="name" class="form-control" placeholder="" value="">
                            </div>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 ">
                            <label>عنوان فارسی  : </label>
                            <div class="input-group ">
                                <input type="text" name="persian_name" class="form-control" placeholder="      " value="">
                            </div>
                            @error('persian_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-4">
                            <label> مجوز ها : </label>
                            <br/>
                            <br/>

                            <div class="row">
                            @foreach ($allPermissions as $permissions)

                                    <div class="col-md-3" style="padding: 20px">
                                        <label class="d-block font-weight-semibold font-size-lg">{{ $groupNamePermissions[$permissions->first()->entity] }}</label>

                                        @foreach ($permissions as $permission)
                                            <div class="custom-control custom-control-right custom-checkbox custom-control-inline mt-4">
                                                <input type="checkbox" name="permissions[]" class="custom-control-input" id="{{ $permission->name }}" value="{{ $permission->name }}">
                                                <label class="custom-control-label position-static" for="{{ $permission->name }}">{{ $permission->persian_name }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                            @endforeach
                            </div>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <button type="submit" class="btn btn-sm btn-success float-left">ثبت اطلاعات جدید   <i class="icon-paperplane  icon-1x"> </i> </button>
                </div>
            </div>
        </form>
    </div>
    <!--end::Card body-->
</div>
@endsection




