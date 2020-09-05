
@if(session()->has('notify'))
    <script>
        Swal.fire({
            // position: 'top-end',
            icon: "{{session('notify')['icon']}}",
            title: "{{session('notify')['title']}}",
            showConfirmButton: false,
            timer: 3000
        })
    </script>
@endif
