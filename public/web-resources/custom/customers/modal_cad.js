
$( document ).ready(function() {
    $('#customerFormCad').submit(function (e) {
        e.preventDefault()
        $(document).on('click', '#btnCadCustomer',  function()  {
            let formSer = $('#customerFormCad').serialize()
            // let formData = new FormData(formSer)
            //     console.log(formData)
            axios.post(
                '/customers',
                formSer,
            ).then(function (reponse) {
                    console.log(reponse)
                }).catch(function (error) {
                // manipula erros da requisição
                console.error("erro =>>"+error);
            })
        });
    })
})