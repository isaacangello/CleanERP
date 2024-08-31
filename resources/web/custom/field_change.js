// var moment = require('moment');

function field_change(element,urlBase,token){
    console.log("url => "+urlBase)
    let field = element.getAttribute('name')
    let id = element.getAttribute('id')
    let value = document.querySelector("#"+id) //element.getAttribute('value')

    console.log('alterando campo '+field+" Via axios com valor => "+value.value)
    // console.log(value.value)
    axios.patch(urlBase,
        {
            _token: token,
            fieldName: field,
            value: value.value,
    })
    .then(resp =>{
                console.log(resp.data.fieldName)
                    element.classList.add('teal', 'lighten-5')
                Toast.fire({
                    icon: "success",
                    title: `New ${field} is successfully saved!`
                });
                switch (resp.data.fieldName) {
                    case "employee1_id":
                        swalConfirm('Employee')

                    case "customer_id":
                        swalConfirm('Customer')

                }
                setTimeout( ()=> {
                    element.classList.remove('teal', 'lighten-5')
                },1000)
            }

    )
    .catch( resp =>{
                element.classList.add('red', 'lighten-5')
            setTimeout(function () {
                element.classList.remove('red', 'lighten-5')
            },1000)
        }
    )

}
function urlGenerate(model,response){
    var urlBase = "";
    switch (model) {
        case'services': urlBase = `api/services/${response}`; break;
        case'employees': urlBase = `api/employee/${response.data.employee1_id}` ; break;
        case'customers': urlBase = `api/customer/${response.data.customer_id}`; break;
        case'commercial': urlBase = `api/commercial-schedule/${response.data.customer_id}`; break;
    }
    return urlBase
}
function modal_changes(element,token,model){
    const service_id = document.querySelector("#serviceId").innerText
    const schedule_id = document.querySelector("#scheduleId").innerText
    switch (model) {
        case'services': field_change(element,urlGenerate(model,service_id),token); break;
        case'employees':
        case'customers':
                axios.get('api/services/'+service_id+'/all:id,customer_id,employee1_id')
                    .then(resp=>{
                        // console.info(resp)
                        field_change(element,urlGenerate(model,resp),token)
                    })
            break;
        case'commercial':
            axios.get('api/commercial-schedule/'+schedule_id+'/all:id,customer_id,employee1_id')
                .then(resp=>{
                    // console.info(resp)
                    field_change(element,urlGenerate(model,resp),token)
                })
    }
    console.log("função modal_change service_id =>"+service_id)
}

function dateTime_change(elementId1,elementId2,token){
    function date_format(day){
        var data = new Date(day),
            dia  = data.getDate().toString().padStart(2, '0'),
            mes  = (data.getMonth()+1).toString().padStart(2, '0'), //+1 pois no getMonth Janeiro começa com zero.
            ano  = data.getFullYear();
        return ano+"-"+mes+"-"+dia;
    }
    const date = document.getElementById(elementId1).value
    const time = document.getElementById(elementId2).value
    const service_id = document.querySelector("#serviceId").innerText
    //element.getAttribute('value')
    let value = `${date} ${time}`
    const urlBase = `api/services/${service_id}`
    console.log('alterando campo service_date Via axios com valor => '+value)
    console.log("url => "+urlBase)
    console.log("date=>"+date+" Time=>"+time)
    const DateToPost = moment(date+" "+time, "MM/DD/YYYY hh:mm").format("YYYY-MM-DD hh:mm:ss")
    console.log("fotmated ->"+DateToPost)
    axios.patch(urlBase,
        {
            _token: token,
            fieldName: "service_date",
            value: DateToPost,
        }).then(resp =>{
                console.log(resp)
                swalConfirm("field date or time" )
            }

        ).catch( resp =>{
            date.classList.add('red', 'lighten-5')
            setTimeout(function () {
                date.classList.remove('red', 'lighten-5')
            },1000)
            time.classList.add('red', 'lighten-5')
            setTimeout(function () {
                time.classList.remove('red', 'lighten-5')
            },1000)


            }
        )

}

function select_billings_changes(El,formId,token,customerId) {
    /**
     * the element of having the name billing-values-selected[]
     * */
    let formEL = document.getElementById(formId)
    let formData  = new FormData(formEL)

    let dataJson = {
         '_token':token,
        'billing_values_selected': formData.getAll('billing-values-selected[]')
    }
    axios.post(' api/update-billing/'+customerId,
        dataJson
        ).then(function (response) {
            console.log(response)
            Toast.fire({
                icon: "success",
                title: `The billing is successfully updated!`
            });

        }
    )
}

// confirm or not service
function startConfirmButtons() {
        let btnConfirm = document.querySelectorAll('.btn-confirm-form')
        console.log(btnConfirm)

        for (let i = 0; i < btnConfirm.length; i++) {
            btnConfirm[i].addEventListener('click',function (event) {
                event.preventDefault()
                let confirFormId =  btnConfirm[i].getAttribute('data-form-id')
                let confirmForm = document.getElementById(confirFormId)

                confirmForm.addEventListener('submit',function (event) {
                    event.preventDefault()
                })
                    let data = new FormData(confirmForm)
                    let dataJson = {

                        '_token': data.get('_token'),
                        'id': data.get('id'),
                        'numWeek': data.get('numWeek'),
                        'confirmed': data.get('confirmed'),

                    }
                    console.log(dataJson)
                axios.post(' api/confirm',
                    dataJson
                ).then(function (response) {
                    console.log(response.data.html)
                    document.getElementById('htmlContent').innerHTML = response.data.html
                    Toast.fire({
                        icon: "success",
                        title: response.data.message
                    });

                })
                startConfirmButtons()

            })

        }
}

startConfirmButtons()


