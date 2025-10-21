@extends('layouts.admin.admin')
@section('content')
    @include('admin.users.index',[
        'active' =>'edit'
    ])
    <div id="kt_content_container" class="container-xxl">
        <form
            class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
             action="{{route('admin.users.update',$user)}}" method="post" enctype="multipart/form-data">
        @csrf
        <!--begin::Main column-->
          <div class="row">
              <div class="col-md-8">
                  <!--begin::General options-->
                  <div class="card card-flush py-4">
                      <!--begin::Card header-->
                      <div class="card-header">
                          <div class="card-title">
                              <h2>ویرایش کاربر</h2>
                          </div>
                          <div class="card-toolbar">
                              <a href="{{route('admin.users.all')}}" class="btn btn-sm btn-light-success "
                                 style="margin-left: 5px">
                                  برگشت
                              </a>

                          </div>
                      </div>
                      <!--end::Card header-->

                      <div class="card-body pt-0 mt-2">
                          <div class="row">
                              <div class="col-md-3">
                                  <div class="mb-10 fv-row fv-plugins-icon-container">
                                      @include('admin.__components.label',['title' => 'نام','required' => 1,])
                                      <div class="mb-5">
                                          @include('admin.__components.input-text',[
                                                  'name' => 'first_name',
                                                  'value'=> $user->first_name
                                                  ])
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="mb-10 fv-row fv-plugins-icon-container">
                                      @include('admin.__components.label',['title' => 'نام خانوادگی','required' => 1,])
                                      <div class="mb-5">
                                          @include('admin.__components.input-text', [
                                                      'name' => 'last_name',
                                                      'value'=> $user->last_name
                                                      ])
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="mb-10 fv-row fv-plugins-icon-container">
                                      @include('admin.__components.label',['title' => 'ایمیل','required' => 1,])
                                      <div class="mb-5">
                                          @include('admin.__components.input-text', [
                                                'name' => 'email',
                                                'value'=> $user->email
                                               ])
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-5">
                                  <div class="mb-10 fv-row fv-plugins-icon-container">
                                      @include('admin.__components.label',['title' => 'شماره موبایل ','required' => 1,])
                                      <div class="mb-5">
                                          @include('admin.__components.input-text',[
                                                      'name' => 'mobile',
                                                      'value'=>$user->mobile
                                                      ])
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="mb-10 fv-row fv-plugins-icon-container">
                                      <!--begin::Label-->
                                  @include('admin.__components.label',['title' => ''])
                                  <!--end::Label-->
                                      <!--begin::Input-->
                                      <div class="mt-3">
                                          <a id="send-sms" class="btn btn-light-primary">ارسال کد اعتبارسنجی</a>
                                          <script>
                                              $(document).ready(function (){
                                                  $("#send-sms").on('click', function (e){
                                                      e.preventDefault();
                                                      let mobile = $('input[name=mobile]').val();
                                                      if(mobile){
                                                          $.ajax({
                                                              url: "{!! route('admin.send.sms') !!}",
                                                              type: 'GET',
                                                              data: {
                                                                  'mobile': mobile,
                                                              },
                                                              success: function (response) {
                                                                  if(response.data.status){
                                                                      Swal.fire({
                                                                          title: "خب",
                                                                          text: response.data.message,
                                                                          icon: 'success',
                                                                          confirmButtonColor: '#01b131',
                                                                          confirmButtonText: "باشه",
                                                                      });
                                                                  }
                                                              },
                                                              error: function (errors) {
                                                                  if(errors.statusText == "OK") {
                                                                      Swal.fire({
                                                                          title: "خطا",
                                                                          text: "مشکلی در ارسال کد اعتبارسنجی به وجود آمده است",
                                                                          icon: 'warning',
                                                                          confirmButtonColor: '#F90',
                                                                          cancelButtonColor: '#CCC',
                                                                          confirmButtonText: "باشه",
                                                                      });
                                                                  }
                                                              }
                                                          });
                                                      }else{
                                                          Swal.fire({
                                                              title: "خطا",
                                                              text: "موبایل را وارد کنید",
                                                              icon: 'warning',
                                                              confirmButtonColor: '#F90',
                                                              cancelButtonColor: '#CCC',
                                                              confirmButtonText: "باشه",
                                                          });
                                                      }

                                                  })
                                              })
                                          </script>
                                      </div>
                                      <!--end::Input-->
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="mb-10 fv-row fv-plugins-icon-container">
                                      <!--begin::Label-->

                                  @include('admin.__components.label',['title' => 'کد اعتبارسنجی'])
                                  <!--end::Label-->
                                      <!--begin::Input-->
                                  @include('admin.__components.input-text', [ 'name' => 'code'])
                                  <!--end::Input-->
                                      <div class="fv-plugins-message-container invalid-feedback"></div>
                                  </div>
                                  @if(session()->has('code_expired'))
                                      <p class="text-danger">{{session()->get('code_expired')}}</p>
                                  @endif
                                  @if(session()->has('code_exception'))
                                      <p class="text-danger">{{session()->get('code_exception')}}</p>
                                  @endif
                              </div>
                          </div>
                      </div>
                      <div class="card-footer d-flex flex-end">
                          <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                              <i class="fa fa-edit"></i>
                              <span class="indicator-label">ویرایش کاربر</span>
                          </button>
                      </div>

                  </div>
                  <!--end::General options-->
                  <!--begin::Automation-->
                  <!--end::Automation-->
              </div>
              <div class="col-md-4">
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
                  <br/>
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
                          @include('admin.__components.image-input', [ 'name' => 'avatar','imageUrl'=>$user->webPresent()->avatar])

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
    <!--    Begin : Success sweet Alert Message scripts -->
    <script>
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            confirmButtonText: 'متوجه شدم',
            title: 'عملیات موفق',
            text: '{{ session('success')}}',
        });
        @endif
    </script>
    <!--     End : Success sweet Alert Message scripts -->
@endsection
