<script>
    @if(session()->has('error'))
    Swal.fire({
        icon: 'error',
        title: 'خطا در عملیات',
        text: '{{ session()->get('error') }}',
    });
    @endif
</script>
<script>
    @if(session()->has('success'))
    Swal.fire({
        icon: 'success',
        title: 'عملیات موفق',
        text: '{{ session()->get('success') }}',
    });
    @endif
</script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
</script>

