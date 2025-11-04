@extends('layouts.admin.admin')
@section('title','  دسته بندی ها ')
@section('pageTitle',' فهرست   دسته بندی ها   ')
@section('content')
    <div class="d-flex flex-end mb-5">
        <button type="button" class="btn  btn-primary px-4 py-2 ml-4" data-bs-toggle="collapse"
                href="#student_filters" role="button"
                aria-expanded="false" aria-controls="collapseExample" style="margin-left: 5px!important;">
            فیلتر
            <i class="fa fa-filter p-0 m-0"></i>
        </button>
    </div>
    <div class="card mb-5 pb-3 mb-xl-8 collapse @if(request()->has('title')) show @else @endif" id="student_filters">
        <form action="" class="form remove-empty-values" method="get" id="remove-empty-values">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">
                        <i class="fa fa-search text-white pl-1"></i>
                        جستجوی پیشرفته
                    </span>
                </h3>
            </div>
            <div class="card-body py-3">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو بر اساس عنوان
                            </label>
                            <input class="form-control form-control-lg form-control-solid" name="title"
                                   placeholder=""
                                   value="{{ request()->has('title') ? request()->get('title') : null }}"/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="form-group">
                            <label class="form-label fs-6 fw-bolder text-dark">جستجو بر اساس وضعیت
                            </label>
                            @include('admin.__components.horizontal-radiobutton', [
                              'activeKey' => request()->has('status') ? request()->get('status') : null ,
                              'name' => 'status',
                              'items' => $activityStatuses
                            ])
                        </div>
                    </div>


                </div>
                <br/>
                <div class="d-flex  flex-end">
                    <a href="{{route('admin.categories.list')}}" class="btn btn-sm btn-light-danger mx-1">
                        <i class="fa fa-eraser p-0 m-0"></i>
                        حذف فیلترها
                    </a>
                    <button type="submit" class="btn btn-sm btn-light-primary mx-1">
                        <i class="fa fa-search"></i>
                        فیلتر
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="card mb-5 mb-xl-8 mt-15">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">فهرست دسته بندی ها </span>
            </h3>
            <div class="card-toolbar">

                <a href="{{route('admin.categories.create')}}" class="btn btn-sm btn-light-success">
                    ثبت دسته بندی جدید
                </a>
            </div>
        </div>


        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">

            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted bg-light">
                            <th class="ps-4  rounded-start">
                                #
                            </th>
                            <th class="ps-4">عنوان دسته بندی</th>
                            <th class="min-w-100px">دسته بندی والد</th>
                            <th class="min-w-100px">وضعیت</th>
                            <th class="min-w-100px ">عملیات</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="row_position" id="category">

                    @if($categories->count() > 0)
                        @foreach($categories as $category)
                            <tr  class="odd" id="{{$category->id}}" data-id="{{$category->id}}" style="border-bottom:1px solid #80808073">
                                <td class="p-5">
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <!--begin::Thumbnail-->
                                        <a href="" class="symbol symbol-50px">
                                            <img class="symbol-label" src="{{$category->webPresent()->image}}"/>
                                        </a>
                                        <!--end::Thumbnail-->
                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="{{ route('admin.categories.edit',$category) }}" class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1" data-kt-ecommerce-category-filter="category_name">    {!! $category->title !!}</a>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {!! $category->webPresent()->parentTitle !!}
                                </td>
                                <td>
                                    {!! $category->webPresent()->status !!}
                                </td>

                                <td class="">

                                    <a href="{{ route('admin.categories.edit',$category) }}"
                                       class="btn btn-icon btn-light-primary btn-sm me-1">
                                     <span class="svg-icon svg-icon-3">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                    </a>
                                   @include('admin.__modules.delete-link',['url' => route('admin.categories.delete',$category)])
                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">
                                <h4 class="text-danger pt-5">دسته بندی ثبت نشده است</h4>
                            </td>
                        </tr>
                    @endif
                    </tbody>

                    <!--end::Table body-->
                </table>
                <!--end::Table-->

            </div>
            {{$categories->render()}}
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
@endsection
@section('style')
   <style>
       #cart-category-create-form{
           z-index: unset !important;
       }
   </style>
@endsection
@section('top-scripts')
     <script src="{{ asset('admin-assets/js/jquery-ui.min.js') }}"></script>
@endsection
@section('scripts')


@endsection
