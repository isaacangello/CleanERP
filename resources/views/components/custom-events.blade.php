<div>

    @script

    <script>

        // console.log('aqui é o livewire')

            console.log(window)
       let tab =        document.querySelectorAll('.tabs')
                let options = {
                    swipeable: true
                }
                 var instance = window.M.Tabs.init(tab, options);
                console.log(instance+" instancia tab")



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
        window.addEventListener('populate-date-time', event=>{
            flatpickr( event.detail.idElement,
                {
                    weekNumbers:true,
                    monthSelectorType:'static',
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    altFormat: 'F j, Y h:i K',
                    altInput: true,
                    onChange: function(selectedDates, dateStr, instance){
                        if (dateStr)
                            instance.close();
                    },
                    defaultDate: `${event.detail.dateTime}`

                }
            )

        })
            window.addEventListener('trigger-confirm-fee', function (event){
                console.log("event fee")
                console.log($wire)
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
                console.log($wire)
                swalConfirmCallback('Do you want to delete this record?','Yes?', ()=> {
                    window.Livewire.dispatch('delete-service')
                })
            })
    </script>
    @endscript

</div>