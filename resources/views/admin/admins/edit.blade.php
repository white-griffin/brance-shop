@extends('layouts.admin.admin')
@section('title','  مدیران  ')
@section('pageTitle','ویرایش '.$admin->webPresent()->fullName)
@section('content')
    @include('admin.admins.index',[
        'active' =>'edit'
])
    <div id="kt_content_container" class="container-xxl">
        <form id="" class=""
              data-kt-redirect="" action="{{route('admin.admins.update',$admin)}}" method="post" enctype="multipart/form-data">
        @csrf
        <!--begin::Main column-->
            <div class="row">
                <div class="col-md-9">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>ویرایش مدیر ({{$admin->webPresent()->fullName}})</h2>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{route('admin.admins.all')}}" class="btn btn-sm btn-light-success "
                                   style="margin-left: 5px">
                                    برگشت
                                </a>

                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 mt-2">
                            <!--begin::Input group-->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">نام  </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.input-text', [ 'name' => 'first_name','value'=>$admin->first_name])
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">نام خانوادگی </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.input-text', [ 'name' => 'last_name','value'=>$admin->last_name])
                                        <!--end::Input-->

                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">شماره موبایل </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.input-text', [ 'name' => 'mobile','value'=>$admin->mobile])
                                        <!--end::Input-->

                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">ایمیل</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.input-text', [ 'name' => 'email','value'=>$admin->email])
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">نام کاربری</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.input-text', [ 'name' => 'username','value'=>$admin->username])
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">پسورد</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.input-text', [ 'name' => 'password','type'=>'password'])
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <hr/>
                                <br/> <br/>
                                <div class="col-lg-6">
                                    <label>انتخاب نقش های دسترسی :</label>
                                    @include('admin.__components.select-2-ajax',
                                   [
                                      'name' => 'roles',
                                       'selectedItems' => $adminRolesArray,
                                      'isMultiple' => true,
                                      'url' => route('admin.roles.search.ajax'),
                                  ])
                                </div>
                                <div class="col-lg-6">
                                    <label>انتخاب مجوز های دسترسی :</label>
                                    @include('admin.__components.select-2-ajax',
                                       [
                                          'name' => 'permissions',
                                          'isMultiple' => true,
                                          'selectedItems' => $adminPermissionsArray,
                                          'url' => route('admin.permissions.search.ajax'),
                                      ])
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                <span class="indicator-label">ثبت اطلاعات  </span>

                            </button>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->
                    <!--begin::Automation-->
                    <!--end::Automation-->
                </div>
                <div class="col-md-3">
                    <!--begin::Status-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>وضعیت</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Select2-->
                            @include('admin.__components.horizontal-radiobutton', [
                              'activeKey' => $admin->status ,
                              'name' => 'status',
                              'items' => $activityStatuses
                              ])
                            <div class="d-none mt-10">
                                <label for="kt_ecommerce_add_category_status_datepicker" class="form-label">Select
                                    publishing date and time</label>
                                <input class="form-control flatpickr-input" id="kt_ecommerce_add_category_status_datepicker"
                                       placeholder="Pick date &amp; time" type="text" readonly="readonly">
                            </div>
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <br/>
                    <!--end::Status-->

                    <br/>
                    <!--end::MentorStatus-->
                    <!--begin::Thumbnail settings-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>تصویر پروفایل</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body text-center pt-0">
                            <!--begin::Image input-->
                            @include('admin.__components.image-input', [ 'name' => 'avatar','imageUrl'=>$admin->webPresent()->avatar])

                            <!--end::Image input-->
                        </div>
                        <!--end::Card body-->
                    </div>

                    <!--end::Thumbnail settings-->
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>

       // load select 2 for select Roles :

       $('#roles').select2({
           placeholder: 'نقش کاربر را انتخاب نمایید',
       });

       // load select 2 for select Permissions :

       $('#permissions').select2({
           dir: 'RTL',
           placeholder: 'مجوزهای کاربر را انتخاب نمایید',
           tags: true
       });

        $('#admins').select2({
            placeholder: '\ کاربر را انتخاب نمایید',
        });


    </script>
@endsection
