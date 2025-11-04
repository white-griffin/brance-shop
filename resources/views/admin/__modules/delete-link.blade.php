
<a href="#" data-target="{{$url}}" title="حذف"
   class="delete-link btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1"  >
    <i class="fa fa-trash" ></i>
</a>
<script>
    jQuery(document).ready(function () {
        $(".delete-link").on('click', function (event) {
            event.preventDefault()
            let url  = $(this).attr('data-target');
            Swal.fire({
                title: "حذف ",
                text: "برای حذف اطمینان دارید ؟",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#ff0008',
                confirmButtonText: "بله , حذف کن !",
                cancelButtonText : "خیر"
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            Swal.fire({
                                title: "خب",
                                text: "حذف با موفقیت انجام شد",
                                icon: 'success',
                                confirmButtonColor: '#01b131',
                                confirmButtonText: "باشه",
                            });
                            location.reload();
                        },
                        error: function (errors) {
                            console.log(errors);
                            if (errors.status == 403){
                                Swal.fire({
                                    title: "خطا",
                                    text: "عدم دسترسی",
                                    icon: 'error',
                                    confirmButtonColor: '#ff0008',
                                    cancelButtonColor: '#CCC',
                                    confirmButtonText: "باشه",
                                });
                            }else {
                                Swal.fire({
                                    title: "خطا",
                                    text: "مشکلی در حذف به وجود آمده است",
                                    icon: 'warning',
                                    confirmButtonColor: '#F90',
                                    cancelButtonColor: '#CCC',
                                    confirmButtonText: "باشه",
                                });
                            }

                        }
                    });

                }
            });
        })
    });
</script>


