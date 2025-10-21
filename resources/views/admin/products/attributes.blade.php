@extends('layouts.admin.admin')
@section('title',' محصولات')
@section('pageTitle','ویرایش محصول')
@section('content')
    @include('admin.products.main-card',[
          'active' =>'attributes'
      ])

    <div id="kt_content_container" class="container-xxl">
        <div class="row">
            <div class="col-md-12">
                <div class="card" data-select2-id="select2-data-131-rhmf">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1"> فهرست مشخصات {{$product->title}} </span>
                        </h3>

                        <div class="card-toolbar">

                            <a class="btn btn-sm btn-light-success" onclick="storeAttribute()">
                                ثبت مشخصات جدید
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

                                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table"
                                            rowspan="1"
                                            colspan="1" style="width: 162.9px;"
                                            aria-label="Customer Name: activate to sort column ascending"> عنوان
                                        </th>
                                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_customers_table">
                                            توضیح
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
                                    @if($attributes->count() > 0)
                                        @foreach($attributes as $attribute)
                                            <tr class="odd">
                                                <td>
                                                    {{$attribute->key}}
                                                </td>
                                                <td>
                                                    {{$attribute->value}}
                                                </td>

                                                <td class="">

                                                    @include('admin.__modules.delete-link',[
                                                          'url' => route('admin.products.delete-attribute',$attribute)
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
            </div>
        </div>
    </div>

@endsection
@section('scripts')
<script>
    function storeAttribute(){
        (async () => {

            const { value: formValues } = await Swal.fire({
                title: 'مشخصات را وارد کنید',
                html:
                    `
                            <div class="mb-5 fv-row fv-plugins-icon-container">
                                <label class="required form-label">عنوان</label>
                                <input id="swal_key_input"  class="swal2-input w-80">
                            </div>
                            <div class="mb-5 fv-row fv-plugins-icon-container">
                                <label class="required form-label">مقدار</label>
                                <input id="swal_value_input"  class="swal2-input w-80">
                            </div>

                    `,

                focusConfirm: false,
                preConfirm: () => {

                }
            })

            if (formValues) {

                $.ajax({
                    type: 'POST',
                    url: "{{route('admin.products.store-attribute',$product)}}",
                    data: {
                        key: document.getElementById('swal_key_input').value,
                        value: document.getElementById('swal_value_input').value,
                        _token: "{!! csrf_token() !!}"
                    },
                    success: function(data){
                        Toast.fire({
                            icon: 'success',
                            title: 'مشخصات با موفقیت اضافه شد'
                        })
                        setTimeout(function() {
                           window.location.reload();
                        }, 3000);

                    },
                    error: function (file, response) {

                        Toast.fire({
                            icon: 'error',
                            title: 'خطا در اضافه کردن مشخصه'
                        })
                    }
                });
            }

        })()
    }
</script>
@endsection
