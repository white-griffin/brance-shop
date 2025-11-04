@extends('layouts.admin.admin')
@section('title','  کاربران  ')
@section('pageTitle',' ویرایش  کاربر ')
@section('content')
    @include('admin.users.main-card',[
       'active' =>'edit'
   ])
    <div id="kt_content_container" class="container-xxl">
        <form id="kt_ecommerce_add_category_form"
              class="form d-flex  flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework "
              data-kt-redirect="" action="{{route('admin.users.update',$user)}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="row">
              <!--begin::Main column-->
              <div class="col-md-9  d-flex flex-column mb-5" >
                  <!--begin::General options-->
                  <div class="card card-flush py-4">
                      <!--begin::Card header-->
                      <div class="card-header">
                          <div class="card-title">
                              <h2>ویرایش پروفایل</h2>
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
                                      @include('admin.__components.input-text', [ 'name' => 'first_name','value'=>$user->first_name])
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
                                      @include('admin.__components.input-text', [ 'name' => 'last_name','value'=>$user->last_name])
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
                                      @include('admin.__components.input-text', [ 'name' => 'mobile','value'=>$user->mobile])
                                      <!--end::Input-->

                                      <div class="fv-plugins-message-container invalid-feedback"></div>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="mb-10 fv-row fv-plugins-icon-container">
                                      <!--begin::Label-->
                                      <label class="required form-label">کدملی</label>
                                      <!--end::Label-->
                                      <!--begin::Input-->
                                      @include('admin.__components.input-text', [ 'name' => 'national_code','value' => $user->national_code])
                                      <!--end::Input-->
                                      <div class="fv-plugins-message-container invalid-feedback"></div>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="mb-10 fv-row fv-plugins-icon-container">
                                      <!--begin::Label-->
                                      <label class="required form-label">تاریخ تولد</label>
                                      <!--end::Label-->
                                      <!--begin::Input-->
                                      @include('admin.__components.datepicker', [ 'name' => 'birth_date'])
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
                                      @include('admin.__components.input-text', [ 'name' => 'email','value'=>$user->email])
                                      <!--end::Input-->
                                      <div class="fv-plugins-message-container invalid-feedback"></div>
                                  </div>
                              </div>

                              <div class="col-md-7">
                                  <div class="mb-10 fv-row fv-plugins-icon-container">
                                      <!--begin::Label-->
                                      <label class="required form-label">آدرس</label>
                                      <!--end::Label-->
                                      <!--begin::Input-->
                                      @include('admin.__components.input-text', [ 'name' => 'address','value' => $user->address])
                                      <!--end::Input-->
                                      <div class="fv-plugins-message-container invalid-feedback"></div>
                                  </div>
                              </div>

                          </div>

                          <!--end::Input group-->
                      </div>
                      <!--end::Card header-->
                  </div>
                  <!--end::General options-->
              </div>
              <!--end::Main column-->

              <!--begin::Aside column-->
              <div class="col-md-3 d-flex flex-column gap-lg-5 mb-5">
                  <!--begin::Status-->
                  <div class="card card-flush py-4 mb-5">
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
                           'activeKey' => $user->status ,
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
                  <!--end::Status-->
                  <!--begin::Status-->
                  <div class="card card-flush py-4 mb-5">
                      <!--begin::Card header-->
                      <div class="card-header">
                          <!--begin::Card title-->
                          <div class="card-title">
                              <h2>وضعیت احراز هویت</h2>
                          </div>
                          <!--end::Card title-->

                      </div>
                      <!--end::Card header-->
                      <!--begin::Card body-->
                      <div class="card-body pt-0">
                          <!--begin::Select2-->
                          @include('admin.__components.horizontal-radiobutton', [
                           'activeKey' => $user->auth_status ,
                            'name' => 'auth_status',
                            'items' => $activityStatuses
                            ])
                      </div>
                      <!--end::Card body-->
                  </div>
                  <!--end::Status-->

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
                          @include('admin.__components.image-input', [
                            'name' => 'avatar',
                            'imageUrl'=>$user->webPresent()->avatar
                            ])

                          <!--end::Image input-->
                      </div>
                      <!--end::Card body-->
                  </div>
                  <!--end::Thumbnail settings-->
              </div>
              <!--end::Aside column-->
             <div class="col-md-3">
                 <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                     <span class="indicator-label">ثبت اطلاعات  </span>
                 </button>
             </div>
          </div>

        </form>
    </div>

@endsection
@section('scripts')

@endsection
