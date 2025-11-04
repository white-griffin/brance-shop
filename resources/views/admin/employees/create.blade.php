@extends('layouts.admin.admin')
@section('title','  اعضا ')
@section('pageTitle',' اضافه کردن اعضا  ')

@section('content')
    <div id="kt_content_container" class="container-xxl">
        <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
              action="{{route('admin.employees.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!--begin::Main column-->
                <div class="col-md-9 d-flex flex-column mb-5" >
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>اضافه کردن اعضا</h2>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{route('admin.employees.list')}}" class="btn btn-sm btn-light-success "
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
                               <div class="col-md-6">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">نام   </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.input-text', [ 'name' => 'title'])
                                        <!--end::Input-->

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">سمت شغلی   </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.input-text', [ 'name' => 'job_position'])
                                        <!--end::Input-->

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class=" form-label">توضیحات</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.ckeditor', [ 'name' => 'description'])
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class=" form-label">لینک سوشال مدیا</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="form-group" id="custom-repeater">
                                            <div data-repeater-list="socials">
                                                <div data-repeater-item class="form-group row align-items-end mb-4">
                                                    {{-- سلکت --}}
                                                    <div class="col-md-5">
                                                        <label class="form-label fw-bold">شبکه</label>
                                                        <select name="social" class="form-select form-select-solid" required>
                                                            <option value="">انتخاب کنید</option>
                                                            <option value="instagram">اینستاگرام</option>
                                                            <option value="telegram">تلگرام</option>
                                                            <option value="whatsapp">واتساپ</option>
															<option value="linkedin">لینکدین</option>
                                                        </select>
                                                    </div>

                                                    {{-- اینپوت --}}
                                                    <div class="col-md-5">
                                                        <label class="form-label fw-bold">لینک</label>
                                                        <input type="text" name="link" class="form-control form-control-solid" placeholder="" required />
                                                    </div>

                                                    {{-- حذف --}}
                                                    <div class="col-md-2 d-flex">
                                                        <a href="javascript:;" data-repeater-delete class="btn btn-light-danger w-100 mt-4">
                                                            <i class="ki-outline ki-trash fs-4"></i> حذف
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- افزودن --}}
                                            <div class="form-group mt-3">
                                                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                    <i class="ki-outline ki-plus fs-3"></i> افزودن شبکه جدید
                                                </a>
                                            </div>
                                        </div>

                                        <!--end::Input-->
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

                    <!--begin::Thumbnail settings-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>تصویر </h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body text-center pt-0">
                            <!--begin::Image input-->
                            @include('admin.__components.image-input', [
                              'name' => 'image',
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
    <script>
        $(document).ready(function () {
            $('#custom-repeater').repeater({
                initEmpty: false,
                defaultValues: {
                    'key': '',
                    'value': ''
                },
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm("آیا مطمئن هستید؟")) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        });
    </script>
@endsection
