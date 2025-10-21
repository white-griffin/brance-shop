@extends('layouts.admin.admin')
@section('title','  وبلاگ ')
@section('pageTitle',' اضافه کردن بلاگ  ')

@section('content')
    <div id="kt_content_container" class="container-xxl">
        <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
              action="{{route('admin.blogs.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!--begin::Main column-->
                <div class="col-md-9 d-flex flex-column mb-5" >
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>اضافه کردن بلاگ</h2>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{route('admin.blogs.list')}}" class="btn btn-sm btn-light-success "
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
                                        <label class="required form-label">عنوان  </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.input-text', [ 'name' => 'title'])
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label"> دسته بندی </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.select-2-ajax', [
                                            'name' => 'category',
                                            'url' => route('admin.blogs.categories.search.ajax'),

                                            ])
                                        <!--end::Input-->

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">اسلاگ  </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.input-text', [ 'name' => 'slug'])
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">نویسنده  </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.select-2-ajax',[
                                              'name' => 'author',
                                              'url' => route('admin.admins.search.ajax'),
                                          ])
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class=" form-label">لینک کنونیکال  </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.input-text', [ 'name' => 'canonical_url'])
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class=" form-label">توضیحات</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.ckeditor', [ 'name' => 'content'])
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <div class="col-md-12 my-5 row">
                                    <div class="col-md-6 mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class=" form-label">متا تایتل </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.ckeditor', [
                                            'name' => 'meta_title'])
                                        <!--end::Input-->

                                    </div>
                                    <div class="col-md-6 mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class=" form-label">متا دیسکریپشن </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.ckeditor', [
                                            'name' => 'meta_description'])
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
                              'activeKey' => $statuses[0]['id'] ,
                              'name' => 'status',
                              'items' => $statuses
                            ])

                            <!--end::Datepicker-->
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
                                <h2>تصویر اصلی</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body text-center pt-0">
                            <!--begin::Image input-->
                            @include('admin.__components.image-input', [
                              'name' => 'main_image',
                              ])

                            <div class=" mb-10 fv-row fv-plugins-icon-container mt-5">
                                <!--begin::Label-->
                                <label class=" form-label">آلت تصویر</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                @include('admin.__components.input-text', [ 'name' => 'image_alt'])
                                <!--end::Input-->

                            </div>
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

