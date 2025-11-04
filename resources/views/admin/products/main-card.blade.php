<div class="" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{$product->webPresent()->image}}" alt="image">

                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="mt-5">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{$product->title}}
                                        </a>


                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column fw-bold fs-6 mb-4 pe-2">

                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <i class="fa fa-th mx-2" aria-hidden="true"></i>
                                            {{$product->category->title}}
                                        </a>
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <i class="fa fa-dollar mx-2" aria-hidden="true"></i>
                                            {{number_format($product->price)}}
                                        </a>

                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <!--begin::Navs-->
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 @if(isset($active) &&  $active == 'edit') active @endif"
                               href="{{route('admin.products.edit',$product)}}">ویرایش اطلاعات</a>
                        </li>

                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 @if(isset($active) &&  $active == 'gallery') active @endif"
                               href="{{route('admin.products.gallery',$product)}}">گالری</a>
                        </li>
                        <!--end::Nav item-->

                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 @if(isset($active) &&  $active == 'attributes') active @endif"
                               href="{{route('admin.products.attributes',$product)}}">مشخصات</a>
                        </li>
                        <!--end::Nav item-->

                    </ul>
                </div>
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
