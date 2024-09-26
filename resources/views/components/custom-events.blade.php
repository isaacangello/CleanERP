<div>

    @script

    <script>
        // console.log('aqui é o livewire')
        // console.log(Livewire)
            Livewire.on('wire-toast-alert', (event) => {
                toastAlert.fire({
                    icon: event.detail.icon,
                    title: event.detail.message
                });
            })
            window.addEventListener('toast-alert', event =>{
                // console.log(event)
                toastAlert.fire({
                    icon: event.detail.icon,
                    title: event.detail.message
                })
                console.log(window)
            })
            window.addEventListener('close-modal', event =>{
                    let modalInstance = window.M.Modal.getInstance(document.getElementById(event.detail.idElement))
                    modalInstance.close()
                })

            window.addEventListener('toggleDisabledBtnDelete', event =>{
                        let btnElements = document.querySelectorAll('.btn-delete')

                        btnElements.forEach(eL =>{
                            console.log(eL)
                            eL.classList.toggle('disabled')
                        })
                    })
            window.addEventListener('enableBtnDelete', event =>{

                    let btnElements = document.querySelectorAll('.btn-delete')

                    btnElements.forEach(eL =>{
                        console.log(eL)
                        if(eL.classList.contains('disabled')){
                            eL.classList.remove('disabled')
                        }else{

                        }

                    })


            })
            window.addEventListener('disabledBtnDelete', event =>{

                    let btnElements = document.querySelectorAll('.btn-delete')

                    btnElements.forEach(eL => {
                        console.log(eL)
                        if (eL.classList.contains('disabled')) {
                        } else {
                            eL.classList.add('disabled')
                        }

                    })

            })
            window.addEventListener('triggerRestoreBilling', function (event){

                swalConfirmCallback('Do you want to restore this record?','Yes?', ()=> {
                    window.Livewire.dispatch('restoreBilling',{id:event.detail.id})
                })
            })

    </script>
    @endscript

</div>