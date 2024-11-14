<div>
        @script
        <script>

            console.log(window)
            window.addEventListener('toast-alert', event =>{
                // console.log(event)
                toastAlert.fire({
                    icon: event.detail.icon,
                    title: event.detail.message
                })
                //console.log(window)
            })
            window.addEventListener('toast-btn-alert', event =>{
                // console.log(event)
                window.Swal.fire({
                        customClass: {
                                confirmButton: "btn btn-link waves-effect waves-light",
                                cancelButton: "btn btn-link btn-danger waves-effect waves-light"
                        },
                    icon: event.detail.icon,
                    title: event.detail.title,
                    text: event.detail.text
                })
                //console.log(window)

            })
        </script>
        @endscript

</div>