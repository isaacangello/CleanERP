<div>

    @script

    <script>
        // console.log('aqui é o livewire')
        // console.log(Livewire)
        Livewire.on('toast-alert', ({ icon,message }) => {
            // Swal.mixin({
            //     toast: true,
            //     position: 'top-end',
            //     showConfirmButton: false,
            //     timer: 3000,
            //     timerProgressBar: true,
            //     didOpen: (toast) => {
            //         toast.onmouseenter = Swal.stopTimer;
            //         toast.onmouseleave = Swal.resumeTimer;
            //     }
            // }).fire({
            //     icon: icon,
            //     title: message
            // })
            toastAlert.fire({
                icon: icon,
                title: message
            });



        })

    </script>
    @endscript

</div>