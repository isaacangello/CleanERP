<div>
    @script
    <script>
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
        document.addEventListener('select-all-checkboxes', event => {

                const checkboxClass = event.detail.checkboxClass;
                const checkboxes = document.querySelectorAll(`.${checkboxClass}`);
                const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);

                checkboxes.forEach(checkbox => {
                        checkbox.checked = !allChecked;
                });
        });

    </script>
</div>