<div>

    @script

    <script>
        // console.log('aqui é o livewire')
        // console.log(Livewire)
            Livewire.on('wire-toast-alert', ({ icon,message }) => {
                toastAlert.fire({
                    icon: icon,
                    title: message
                });
            })
            window.addEventListener('toast-alert', event =>{
                // console.log(event)
                toastAlert.fire({
                    icon: event.detail.icon,
                    title: event.detail.message
                })
            })
            window.addEventListener('close-modal', event =>{
                    let modalInstance = window.M.Modal.getInstance(document.getElementById(event.detail.idElement))
                    modalInstance.close()
                })

            window.addEventListener('disabledBtnDelete', event =>{
                        let btnElements = document.querySelectorAll('.btn-delete')

                        btnElements.forEach(eL =>{
                            //console.log(eL)
                            eL.classList.toggle('disabled')
                        })
                    })


    </script>
    @endscript

</div>