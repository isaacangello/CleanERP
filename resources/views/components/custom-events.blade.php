<div>

    @script

    <script>
        document.addEventListener('livewire:initialized', () => {
            // Runs immediately after Livewire has finished initializing
            // on the page...
            var elems = document.querySelectorAll('.modal-on-livewire');
            var ModalAllInstances = M.Modal.init(elems, {
                preventScrolling: true,
                dismissible: false,
                inDuration: 400,
                outDuration:400,
                startingTop: '0%',
                endingTop: '10%',
            });

        })
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
        window.addEventListener('populate-date', event=>{
            flatpickr( event.detail.idElement,     {
                weekNumbers:true,
                monthSelectorType:'static',
                dateFormat:'Y-m-d',
                altFormat:'F j, Y',
                altInput:true,
                defaultDate:`${event.detail.date}`
            })

        })
        window.addEventListener('populate-time', event=>{
            flatpickr( event.detail.idElement,
                {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: 'H:i',
                    altFormat: 'h:i K',
                    altInput: true,
                    defaultDate: `${event.detail.time}`

                }
            )

        })
            window.addEventListener('trigger-confirm-fee', function (event){
                console.log("event fee")
                swalConfirmCallback('Do you want to change fee status?','Yes?', ()=> {
                    window.Livewire.dispatch('toggle-fee')
                })
            })
            window.addEventListener('trigger-confirm-fee', function (event){
                console.log("event fee")
                swalConfirmCallback('Do you want to change fee status?','Yes?', ()=> {
                    window.Livewire.dispatch('toggle-fee')
                })
            })
            window.addEventListener('trigger-cancel-fee', function (event){
                console.log("event cancel fee")
                swalConfirmCallback('Do you want to change fee status?','Yes?', ()=> {
                    window.Livewire.dispatch('cancel-fee', {id:event.detail.id})
                })
            })

            window.addEventListener('trigger-confirm-delete', function (event){

                swalConfirmCallback('Do you want to delete this record?','Yes?', ()=> {
                    window.Livewire.dispatch('delete-service')
                })
            })

    </script>
    @endscript

</div>