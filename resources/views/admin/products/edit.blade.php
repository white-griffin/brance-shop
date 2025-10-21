@extends('layouts.admin.admin')
@section('title',' محصولات')
@section('pageTitle','ویرایش محصول')
@section('content')
    @include('admin.products.main-card',[
          'active' =>'edit'
      ])
    <div id="kt_content_container" class="container-xxl">
        <form id="kt_ecommerce_add_category_form"
              class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
              data-kt-redirect="" action="{{route('admin.products.update',$product)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!--begin::Main column-->
                <div class="col-md-9 d-flex flex-column mb-2" >
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>ویرایش محصول : {{$product->title}}</h2>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{route('admin.products.list')}}" class="btn btn-sm btn-light-success "
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
                                <div class="col-md-4 mt-5">
                                    <!--begin::Label-->
                                    <label class="required form-label">عنوان محصول </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    @include('admin.__components.input-text', [
                                        'name' => 'title' ,
                                        'value' => $product->title
                                    ])
                                    <!--end::Input-->

                                </div>
                                <div class="col-md-4 mt-5">
                                    <!--begin::Label-->
                                    <label class="required form-label">دسته بندی  </label>
                                    <!--end::Label-->
                                    @include('admin.__components.select-2-ajax', [
                                         'name' => 'category',
                                         'url' => route('admin.products.categories.search.ajax'),
                                         'selectedItems' => (isset($product->category_id))? [
                                        ['id' => $product->category_id,'title'=> $product->category->title]
                                        ] : null
                                     ])

                                </div>
                                <div class="col-md-4 mt-5">
                                    <!--begin::Label-->
                                    <label class="required form-label">کد محصول </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    @include('admin.__components.input-text', [
                                        'name' => 'product_code',
                                        'value' => $product->product_code
                                     ])
                                    <!--end::Input-->

                                </div>
                                <div class="col-md-4 mt-5">
                                    <!--begin::Label-->
                                    <label class="required form-label">قیمت </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    @include('admin.__components.input-text', [
                                        'name' => 'price',
                                        'type' => 'number',
                                         'value' => $product->price
                                     ])
                                    <!--end::Input-->

                                </div>
                                <div class="col-md-4 mt-5">
                                    <!--begin::Label-->
                                    <label class="required form-label">درصد تخفیف </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    @include('admin.__components.input-text', [
                                        'name' => 'discount_percent' ,
                                        'type' => 'number',
                                        'value' => $product->discount_percent
                                        ])
                                    <!--end::Input-->

                                </div>
                                <div class="col-md-4 mt-5">
                                    <!--begin::Label-->
                                    <label class="required form-label">تعداد </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    @include('admin.__components.input-text', [
                                        'name' => 'quantity' ,
                                        'type' => 'number',
                                        'value' => $product->quantity])
                                    <!--end::Input-->

                                </div>
                                <div class="col-md-4 mt-5">
                                    <!--begin::Label-->
                                    <label class="required form-label">اسلاگ </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    @include('admin.__components.input-text', [ 'name' => 'slug','value' => $product->slug])
                                    <!--end::Input-->

                                </div>
                                <div class="col-md-8 mt-5">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label">لینک کنونیکال  </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.input-text', [ 'name' => 'canonical_url','value' => $product->canonical_url])
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <div class="col-md-12 my-5">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class=" form-label">توضیحات کلی </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.ckeditor', [
                                            'name' => 'description',
                                            'value' => $product->description])
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
                                            'name' => 'meta_title',
                                            'value' => $product->meta_title])
                                        <!--end::Input-->

                                    </div>
                                    <div class="col-md-6 mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class=" form-label">متا دیسکریپشن </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        @include('admin.__components.ckeditor', [
                                            'name' => 'meta_description',
                                            'value' => $product->meta_description])
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
                <div class="col-md-3 d-flex flex-column gap-lg-5">

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
                              'activeKey' => $product->status ,
                              'name' => 'status',
                              'items' => $activityStatuses
                              ])

                            <!--end::Datepicker-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Status-->

                    <!--begin::DiscountStatus-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>وضعیت تخفیف</h2>
                            </div>
                            <!--end::Card title-->

                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Select2-->
                            @include('admin.__components.horizontal-radiobutton', [
                              'activeKey' => $product->discount_status ,
                              'name' => 'discount_status',
                              'items' => $activityStatuses
                              ])

                            <!--end::Datepicker-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::DiscountStatus-->

                    <!--begin::SpecialStatus-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>وضعیت فروش ویژه</h2>
                            </div>
                            <!--end::Card title-->

                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Select2-->
                            @include('admin.__components.horizontal-radiobutton', [
                              'activeKey' => $product->special_status ,
                              'name' => 'special_status',
                              'items' => $activityStatuses
                              ])

                            <!--end::Datepicker-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::SpecialStatus-->

                    <!--begin::Image-->
                    <div class="card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>تصویر محصول</h2>
                            </div>
                            <!--end::Card title-->

                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body text-center pt-0">
                            <!--begin::Select2-->
                            @include('admin.__components.image-input', [
                            'name' => 'image',
                            'imageUrl' => $product->webPresent()->image
                            ])
                            <div class=" mb-10 fv-row fv-plugins-icon-container mt-5">
                                <!--begin::Label-->
                                <label class=" form-label">آلت تصویر</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                @include('admin.__components.input-text', [ 'name' => 'image_alt','value' => $product->image_alt])
                                <!--end::Input-->

                            </div>
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Image-->

                    <!--end::Thumbnail settings-->
                </div>

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

