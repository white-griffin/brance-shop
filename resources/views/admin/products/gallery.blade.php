@extends('layouts.admin.admin')
@section('title',' محصولات')
@section('pageTitle','ویرایش محصول')
@section('content')
    @include('admin.products.main-card',[
          'active' =>'gallery'
      ])

    <div id="kt_content_container" class="container-xxl">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>  گالری  {{$product->title}}</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Input group-->
                        <!--begin::Card toolbar-->
                        <div class="fv-row mb-2">
                            <!--begin::Dropzone-->
                            <form method="post" action="{{route("admin.products.upload-gallery",$product)}}"
                                  enctype="multipart/form-data" class="dropzone" id="dropzone">
                                @csrf
                                <input name="duration" id="duration" class="d-none">
                                <input name="link" id="link" class="d-none">
                                <input name="alt" id="alt" class="d-none">

                                <div class="dropzone dz-clickable" id="kt_ecommerce_add_product_media">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <!--begin::Icon-->
                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bold text-gray-900 mb-1">فایل ها را اینجا رها کنید یا برای
                                                آپلود کلیک کنید.</h3>
                                            <span
                                                class="fs-7 fw-semibold text-gray-400">همزمان مجاز به اپلود 3 فایل هستید</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                            </form>

                            <!--end::Dropzone-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">گالری رسانه محصول را تنظیم کنید.</div>
                        <br/>
                        <br/>
                        <div class="text-muted fs-7">
                            <a href="{{route('admin.products.gallery',$product)}}" id="kt_ecommerce_add_category_submit"
                               class="btn btn-primary">
                                <span class="indicator-label">ثبت اطلاعات  </span>

                            </a>
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Card header-->
                </div>
            </div>

        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="card" data-select2-id="select2-data-131-rhmf">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1"> فهرست گالری </span>
                        </h3>

                    </div>
                    <!--begin::Card body-->
                    <div class="card-body pt-0">

                        <!--begin::Table-->
                        <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                       id="kt_customers_table">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="min-w-125px sorting">

                                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table"
                                            rowspan="1"
                                            colspan="1" style="width: 162.9px;"
                                            aria-label="Customer Name: activate to sort column ascending"> تصویر
                                        </th>
                                        <th class="min-w-125px sorting" rowspan="1" colspan="1"
                                            style="width: 162.9px;" aria-label="Actions">نوع محتوا
                                        </th>
                                        <th class="min-w-125px sorting" rowspan="1" colspan="1"
                                            style="width: 162.9px;" aria-label="Actions">alt
                                        </th>
                                        <th class="min-w-125px sorting" rowspan="1" colspan="1"
                                            style="width: 162.9px;" aria-label="Actions">عملیات
                                        </th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                    @if($files->count() > 0)
                                        @foreach($files as $file)
                                            <tr class="odd">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin:: Avatar -->
                                                        @if($file->type == \App\Constants\Constant::VIDEO)
                                                            <img src="{{asset('admin-assets/media/avatars/video.png')}}"
                                                                 style="width:50px "/>
                                                            <a href="{{asset(\App\Constants\Constant::PRODUCT_GALLERY_PATH.$file->name)}}"
                                                               style="margin-right: 10px">نمایش ویدیو</a>
                                                        @else
                                                            <div
                                                                class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                <a href="#">
                                                                    <div class="symbol-label">

                                                                        <img
                                                                            src="{{asset(\App\Constants\Constant::PRODUCT_GALLERY_PATH.$file->name)}}"
                                                                            alt="Ana Crown"
                                                                            class="w-100">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <!--end::Avatar-->
                                                    </div>
                                                </td>
                                                <td> {!! $file->webPresent()->getType !!}</td>
                                                <td> {!! $file->alt !!}</td>
                                                <td class="">

                                                    @include('admin.__modules.delete-link',[
                                                          'url' => route('admin.products.delete-gallery',$file)
                                                      ])

                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" style="text-align:center;color:red"><a class="btn btn-danger" href="">
                                                    اطلاعات موجود نیست <i class="icon-warning2 mr-3 icon-1x"></i></a></td>
                                        </tr>
                                    @endif
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                            </div>

                        </div>
                        <!--end::Table-->

                    </div>
                    <!--end::Card body-->
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    <script type="text/javascript">
        Dropzone.autoDiscover = false
        let myDropzone = new Dropzone('#dropzone', {
            uploadMultiple: false,
            autoProcessQueue: false,
            renameFile: function (file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;

            },
            init: function() {

                this.on("addedfile", function(file) {
                    Swal.fire({
                        title: "alt را وارد کنید",
                        html: `
    <input id="swal_alt" style="max-width: 90%" class="swal2-input" placeholder="alt">
  `,
                        focusConfirm: false,
                        showCancelButton: true,
                        confirmButtonText: 'تایید',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            document.getElementById('alt').value = document.getElementById('swal_alt').value;

                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Object.assign(file,{
                                preview: URL.createObjectURL(file)
                            })
                            if(file.type.split('/')[0] === 'video'){

                                const video = document.createElement("video");
                                video.src = file.preview;

                                video.addEventListener("loadedmetadata", () => {
                                    let duration = document.getElementById('duration');
                                    duration.value = parseInt(video.duration)
                                    myDropzone.processQueue() ;
                                });


                            }else {

                                setTimeout(() => {
                                    myDropzone.processQueue() ;
                                }, 10);

                            }
                        }
                    })


                });

            },

            addRemoveLinks: true,
            removedfile: function(file) {


                $.ajax({
                    type: 'POST',
                    url: "{{route('admin.products.delete-by-name-gallery')}}",
                    data: {
                        name: file.upload.filename,
                        _token: "{!! csrf_token() !!}"
                    },
                    success: function(data){
                        Toast.fire({
                            icon: 'success',
                            title: 'فایل با موفقیت حذف شد'
                        })
                        file.previewElement.remove();
                    },
                    error: function (file, response) {
                        Toast.fire({
                            icon: 'error',
                            title: 'خطا در حذف فایل'
                        })
                    }
                });



            },
            success: function (file, response) {

                Toast.fire({
                    icon: 'success',
                    title: 'فایل با موفقیت آپلود شد'
                })
            },
            error: function (file, response) {
                alert('خطا');
            }

        });

    </script>

@endsection
