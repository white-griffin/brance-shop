@extends('layouts.admin.admin')
@section('title','  اسلایدر ')
@section('pageTitle',' فهرست اسلایدر  ')

@section('content')


    <div id="kt_content_container" class="container-xxl">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2> فهرست اسلایدر </h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Input group-->
                        <!--begin::Card toolbar-->
                        <div class="fv-row mb-2">
                            <!--begin::Dropzone-->
                            <form method="post" action="{{route("admin.sliders.store")}}"
                                  enctype="multipart/form-data" class="dropzone" id="dropzone">
                                @csrf
                                <input name="link" id="link" class="d-none">
                                <input name="title" id="title" class="d-none">


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
                            <a href="{{route('admin.sliders.list')}}" id="kt_ecommerce_add_category_submit"
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
                            <span class="card-label fw-bolder fs-3 mb-1"> فهرست اسلایدر </span>
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

                                        <th class="min-w-125px sorting" rowspan="1" colspan="1"
                                            style="width: 162.9px;" aria-label="Actions">شناسه
                                        </th>
                                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table"
                                            rowspan="1"
                                            colspan="1" style="width: 162.9px;"
                                            aria-label="Customer Name: activate to sort column ascending"> تصویر
                                        </th>
                                        <th class="min-w-125px sorting" rowspan="1" colspan="1"
                                            style="width: 162.9px;" aria-label="Actions">نوع اسلایدر
                                        </th>
                                        <th class="min-w-125px sorting" rowspan="1" colspan="1"
                                            style="width: 162.9px;" aria-label="Actions">عنوان
                                        </th>
                                        <th class="min-w-125px sorting" rowspan="1" colspan="1"
                                            style="width: 162.9px;" aria-label="Actions">لینک
                                        </th>
                                        <th class="min-w-125px sorting" rowspan="1" colspan="1"
                                            style="width: 162.9px;" aria-label="Actions">تنظیمات
                                        </th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                    @if($sliders->count() > 0)
                                        @foreach($sliders as $file)
                                            <tr class="odd">
                                                <td> {{$file->id}}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin:: Avatar -->
                                                        @if($file->type == \App\Constants\Constant::VIDEO)
                                                            <img src="{{asset('admin-assets/media/avatars/video.png')}}"
                                                                 style="width:50px "/>
                                                            <a href="{{asset(\App\Constants\Constant::SLIDERS_FILE_PATH.$file->name)}}"
                                                               style="margin-right: 10px">نمایش ویدیو</a>
                                                        @else
                                                            <div
                                                                class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                <a href="#">
                                                                    <div class="symbol-label">

                                                                        <img
                                                                            src="{{asset(\App\Constants\Constant::SLIDERS_FILE_PATH.$file->name)}}"
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
                                                <td> {{$file->title}}</td>
                                                <td>
                                                    @if(!is_null($file->link))
                                                        <a href="http://www.{{$file->link}}" target="_blank">
                                                            مشاهده صفحه لینک
                                                        </a>
                                                    @else
                                                        لینک وجود ندارد
                                                    @endif
                                                </td>

                                                <td class="">

                                                    @include('admin.__modules.delete-link',[
                                                          'url' => route('admin.sliders.delete',$file)
                                                      ])

                                                    <a type="button" data-bs-toggle="modal" data-bs-target="#edit_{{$file->id}}"
                                                       class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <i class="fa fa-pencil" ></i>
                                                    </a>
                                                </td>

                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="edit_{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="editFileModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{route('admin.sliders.update',$file)}}" method="post" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editFileModalLabel">ویرایش فایل</h5>
                                                            </div>
                                                            <div class="modal-body">

                                                                @csrf
                                                                <div>
                                                                    @include('admin.__components.label',['title' => 'ویرایش عکس'])
                                                                    <img
                                                                        src="{{asset(\App\Constants\Constant::SLIDERS_FILE_PATH.$file->name)}}"
                                                                        alt="Ana Crown" id="fileReview"
                                                                        class="w-100">

                                                                    <input name="file" class="form-control form-control-sm mt-5" type="file" onchange="readFileURL(this);">
                                                                </div>

                                                                <div class="mt-5">
                                                                    @include('admin.__components.label',['title' => 'ویرایش لینک'])
                                                                    @include('admin.__components.input-text',[
                                                                        'name' => 'link',
                                                                        'value' => $file->link
                                                                    ])
                                                                </div>
                                                                <div class="mt-5">
                                                                    @include('admin.__components.label',['title' => 'ویرایش عنوان'])
                                                                    @include('admin.__components.input-text',[
                                                                        'name' => 'title',
                                                                        'value' => $file->title
                                                                    ])
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                                                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
                        title: "عنوان و لینک را وارد کنید",
                        html: `
    <input id="swal_title" style="max-width: 90%" class="swal2-input" placeholder="عنوان">
    <input id="swal_link" style="max-width: 90%" class="swal2-input" placeholder="لینک">
  `,
                        focusConfirm: false,
                        showCancelButton: true,
                        confirmButtonText: 'تایید',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            document.getElementById('title').value = document.getElementById('swal_title').value;
                            document.getElementById('link').value = document.getElementById('swal_link').value;

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
                    url: "{{route('admin.sliders.delete-by-name-slider')}}",
                    data: {
                        name: file.upload.filename,
                        _token: "{!! csrf_token() !!}",
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
    <script>
        function readFileURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#fileReview')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
