
$( document ).ready(function() {

    $('#customerFormCad').submit(function (e) {
        e.preventDefault()

            let formSer = $(this).serialize()
            // let formData = new FormData(formSer)
            //     console.log(formData)
            axios.post(
                '/customers',
                formSer,
            ).then(function (resp) {
                    if(resp.status >=200 && resp.status <=299){
                    console.log(resp.status)
                    $('#new-customer').modal('close')

                }// location.reload()
            }).catch(function (error) {
                // manipula erros da requisição
                console.error("erro =>>" + error);
            })


    })
})