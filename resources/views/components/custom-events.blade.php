<div>

    @script

    <script>

        // console.log('aqui é o livewire')

            console.log(window)



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
                monthSelectorType:'dropdown',
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
            if(event.detail.dateTime){
                flatpickr( event.detail.idElement,
                    {
                        weekNumbers:true,
                        monthSelectorType:'dropdown',
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        altFormat: 'F j, Y h:i K',
                        altInput: true,
                        // onChange: function(selectedDates, dateStr, instance){
                        //     if (dateStr)
                        //         instance.close();
                        // },
                        defaultDate: `${event.detail.dateTime}`

                    }
                )
            }else{
                flatpickr( event.detail.idElement,
                    {
                        weekNumbers:true,
                        monthSelectorType:'dropdown',
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        altFormat: 'F j, Y h:i K',
                        altInput: true,
                        // onChange: function(selectedDates, dateStr, instance){
                        //     if (dateStr)
                        //         instance.close();
                        // },

                    }
                )
            }

        })

        document.addEventListener('select-cad-employee', event => {
            const empId = event.detail.empId;
            // const selectElementC = document.getElementById('select-cad-service-customer');
            // selectElementC.querySelectorAll('option').forEach(option => {
            //     if (option.value === '712') {
            //         option.setAttribute('selected', 'selected');
            //     } else {
            //         option.removeAttribute('selected');
            //     }
            // });
            // const selectElementE = document.getElementById('select-cad-service-employee1');
            //
            // selectElementE.querySelectorAll('option').forEach(option => {
            //     if (option.value === empId) {
            //         option.setAttribute('selected', 'selected');
            //     } else {
            //         option.removeAttribute('selected');
            //     }
            // });
            window.Livewire.dispatch('populate-date-time', {idElement: "#input-cad-service-date", dateTime: event.detail.dateTime});
            window.Livewire.dispatch('populate-on-open', {empId: empId,date: event.detail.dateTime});
            $wire.showCadModal = true;
        });

        // window.addEventListener('select-all-checkboxes', event => {
        //         const checkboxClass = event.detail.checkboxClass;
        //         const checkboxes = document.querySelectorAll(`.${checkboxClass}`);
        //
        //         checkboxes.forEach(checkbox => {
        //             checkbox.checked = true;
        //         });
        //     });
        document.addEventListener('select-all-checkboxes', event => {
            console.log("select-all-checkboxes:  ".event)
            const checkboxClass = event.detail.checkboxClass;
            const checkboxes = document.querySelectorAll(`.${checkboxClass}`);
            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);

            checkboxes.forEach(checkbox => {
                checkbox.checked = !allChecked;
            });
        });
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