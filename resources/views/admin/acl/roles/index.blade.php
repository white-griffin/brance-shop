@extends('layouts.admin.admin')
@section('title',' مدیریت  سطوح دسترسی ')
@section('pageTitle','   مدیریت نقش ها ')
@section('pageTitleSingle','    لیست نقش ها ')
@section('content')

    <div class="card" data-select2-id="select2-data-131-rhmf">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1"> فهرست نقش ها </span>
            </h3>
            <div class="card-toolbar">

                <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-light-success">
                    ثبت نقش جدید
                </a>
            </div>
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
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1"
                                colspan="1" style="width: 162.9px;"
                                aria-label="Created Date: activate to sort column ascending"> #
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1"
                                colspan="1" style="width: 162.9px;"
                                aria-label="Customer Name: activate to sort column ascending"> عنوان
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1"
                                colspan="1" style="width: 162.9px;"
                                aria-label="Customer Name: activate to sort column ascending"> عنوان فارسی
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table" rowspan="1"
                                colspan="1" style="width:162.9px;"
                                aria-label="Status: activate to sort column ascending">تنظیمات
                            </th>

                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                        @if($roles->count() > 0)
                            @foreach ($roles as $key => $role)
                                <tr class="odd">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->persian_name }}</td>
                                    <td>

                                        <a class="btn btn-icon btn-light-primary btn-sm me-1"
                                           href="{{ route('admin.roles.edit',$role) }}">
                                        <span class="svg-icon svg-icon-3">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_new_ticket{{$role->id}}"
                                           class="btn btn-icon btn-light-info btn-sm me-1">   <span class="svg-icon svg-icon-3">
                                                <i class="fa fa-layer-group"></i>
                                            </span></a>
                                        <div class="modal fade" id="kt_modal_new_ticket{{$role->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
                                            <!--begin::Modal dialog-->
                                            <div class="modal-dialog modal-dialog-centered mw-750px">
                                                <!--begin::Modal content-->
                                                <div class="modal-content rounded">
                                                    <!--begin::Modal header-->
                                                    <div class="modal-header pb-0 border-0 justify-content-end">
                                                        <!--begin::Close-->
                                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                            <span class="svg-icon svg-icon-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                     viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                                                          rx="1" transform="rotate(-45 6 17.3137)"
                                                                          fill="currentColor"></rect>
                                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                                          transform="rotate(45 7.41422 6)"
                                                                          fill="currentColor"></rect>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </div>
                                                        <!--end::Close-->
                                                    </div>
                                                    <!--begin::Modal header-->
                                                    <!--begin::Modal body-->
                                                    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                        <!--begin:Form-->
                                                        <form id="kt_modal_new_ticket_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                                                              action="#">
                                                            <!--begin::Heading-->
                                                            <div class="mb-13 text-center">
                                                                <!--begin::Title-->
                                                                <h1 class="mb-3">مجوز های نقش مربوط</h1>
                                                                <br/>
                                                                <!--end::Title-->
                                                                <!--begin::Description-->
                                                                <div class="text-gray-400 fw-bold fs-5">
                                                                    @foreach($role->permissions as $permission)
                                                                        <span class="badge badge-light-success">{{ $permission->persian_name }}</span>
                                                                    @endforeach

                                                                </div>
                                                                <!--end::Description-->
                                                            </div>
                                                            <!--end::Heading-->
                                                            <div></div>
                                                        </form>
                                                        <!--end:Form-->
                                                    </div>
                                                    <!--end::Modal body-->
                                                </div>
                                                <!--end::Modal content-->
                                            </div>
                                            <!--end::Modal dialog-->
                                        </div>
                                        <a class="btn btn-icon btn-light-danger btn-sm me-1 delete-confirm"
                                           href="javascript:" data-id="{{ $role->id }}">
                                          <span class="svg-icon svg-icon-3">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </a>
                                    </td>

                                    <!--end::Date=-->
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
                <div class="row">
                    <div
                        class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">

                    </div>
                </div>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
@endsection
@section('scripts')

    <script>
        $(document).ready(function () {

            @if(session('role.create'))
            Swal.fire({
                title: "عملیات موفق",
                text: "{{ session('role.create') }}",
                icon: "success",
                confirmButtonText: 'متوجه شدم',
                confirmButtonColor: '#1bc5bd'
            });
            @endif
            $('.delete-confirm').on('click', function (event) {
                event.preventDefault();
                let role_id = $(this).data("id");
                let url = "{{ route('admin.roles.delete',":role_id") }}";
                url = url.replace(":role_id", role_id);

                Swal.fire({
                    title: 'حذف نقش !',
                    text: "آیا مطمئن هستید ؟",
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonColor: 'red',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'بله,حذف کن',
                    cancelButtonText: 'خیر',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        window.location.href = url;
                    }
                });
            });
            @if(session('role.deleted'))
            Swal.fire({
                title: "عملیات موفق",
                text: "{{ session('role.deleted') }}",
                icon: "success",
                confirmButtonText: 'متوجه شدم',
                confirmButtonColor: '#1bc5bd'
            });
            @endif
            @if(session('role.updated'))
            Swal.fire({
                title: "عملیات موفق",
                text: "{{ session('role.updated') }}",
                icon: "success",
                confirmButtonText: 'متوجه شدم',
                confirmButtonColor: '1bc5bd'
            });
            @endif

        });

    </script>

@endsection
