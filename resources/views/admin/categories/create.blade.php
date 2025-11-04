@extends('layouts.admin.admin')
@section('title',' دسته بندی ها')
@section('pageTitle','ثبت دسته بندی جدید')
@section('content')

    <div id="kt_content_container" class="container-xxl">
        <form id="kt_ecommerce_add_category_form"
              class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
              data-kt-redirect="" action="{{route('admin.categories.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10" style="margin-left: 20px ">
                <!--begin::General options-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>ثبت دسته بندی جدید</h2>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{route('admin.categories.list')}}" class="btn btn-sm btn-light-success "
                               style="margin-left: 5px">
                                بازگشت
                            </a>

                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 mt-2">
                        <!--begin::Input group-->
                        <div class="row mb-8">
                            <div class="col-md-4">
                                <!--begin::Label-->
                                <label class="required form-label">عنوان دسته بندی </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                @include('admin.__components.input-text', [ 'name' => 'title' ])
                                <!--end::Input-->

                            </div>
                            <div class="col-md-4">
                                <!--begin::Label-->
                                <label class=" form-label">دسته بندی والد </label>
                                <!--end::Label-->
                                <select class="form-control  form-select form-select-solid" id="parent_category" name="parent_category"></select>
                                @error('parent_category')
                                <p class="text-danger">{{$message}}</p>
                                @enderror

                            </div>
                            <div class="col-md-4">
                                <!--begin::Label-->
                                <label class="required form-label">اسلاگ </label>
                                <!--end::Label-->
                                @include('admin.__components.input-text', [ 'name' => 'slug'])


                                @error('slug')
                                <p class="text-danger">{{$message}}</p>
                                @enderror

                            </div>
                            <div class="col-md-12 mt-5">
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required form-label">لینک کنونیکال  </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    @include('admin.__components.input-text', [ 'name' => 'canonical_url'])
                                    <!--end::Input-->
                                </div>
                            </div>
                            <div class="col-md-12 my-5">
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class=" form-label">توضیحات</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    @include('admin.__components.ckeditor', [ 'name' => 'description'])
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
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

                <!--begin::Type-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>نوع دسته بندی</h2>
                        </div>
                        <!--end::Card title-->

                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Select2-->
                        @include('admin.__components.horizontal-radiobutton', [
                          'activeKey' => $categoryTypes[0]['id'],
                          'name' => 'type',
                          'items' => $categoryTypes
                          ])

                        <!--end::Datepicker-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Type-->

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
                          'activeKey' => $activityStatuses[0]['id'] ,
                          'name' => 'status',
                          'items' => $activityStatuses
                          ])

                        <!--end::Datepicker-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Status-->

                <!--begin::Image-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>تصویر دسته بندی</h2>
                        </div>
                        <!--end::Card title-->

                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Select2-->
                        @include('admin.__components.image-input', [ 'name' => 'image'])
                        <div class=" mb-10 fv-row fv-plugins-icon-container mt-5">
                            <!--begin::Label-->
                            <label class=" form-label">آلت تصویر</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            @include('admin.__components.input-text', [ 'name' => 'image_alt'])
                            <!--end::Input-->

                        </div>
                        <!--end::Datepicker-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Image-->

                <div class="d-flex justify-content-end">
                    <!--begin::Button-->
                    <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                        <span class="indicator-label">ثبت اطلاعات </span>

                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Thumbnail settings-->
            </div>


        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            initializeSelect2('product')
        })
        $('input[type=radio][name=type]').on('change', function() {

            $('#parent_category').select2('destroy').empty();
            initializeSelect2($(this).val())

        });

        function initializeSelect2(type) {
            // Format selection
            $('#parent_category').select2({
                language: {
                    inputTooShort: function (args) {
                        let remainingChars = args.minimum - args.input.length;
                        return 'حداقل ' + remainingChars + ' حرف یا بیشتر برای جستجو وارد کنید';
                    },
                    noResults: function () {
                        return 'نتیجه ای یافت نشد !';
                    },
                },
                allowClear: true,
                placeholder: "انتخاب ",
                minimumInputLength: 1,
                ajax: {
                    url: "{!! route('admin.categories.search.ajax') !!}",
                    dataType: 'json',
                    delay: 20,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            type:type,
                        };
                    },
                    processResults: function (response, params) {
                        let category = response.data;
                        params.page = params.page || 1;
                        return {
                            results: category,
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                templateResult: levelFormatRepo, // omitted for brevity, see the source of this page
                templateSelection: levelFormatRepoSelection // omitted for brevity, see the source of this page

            });
            // Format displayed data
            function levelFormatRepo(repo) {
                if (repo.loading) return 'در حال جستجو ...';
                return repo.name;
            }
            // Format selection
            function levelFormatRepoSelection(repo) {
                if (repo.name === undefined) return repo.text;
                return repo.name ;
            }// Format selection

        }

    </script>
@endsection

