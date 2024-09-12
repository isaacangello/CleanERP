import {isValidElement,isNullOrUndef,serialize,errorShow} from "./helpers/funcs.js";
import {push_run} from './modalPush.js'
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
                toastAlert.fire({
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
        case'services': urlBase = `/api/services/${response}`; break;
        case'employees': urlBase = `/api/employee/${response.data.employee1_id}` ; break;
        case'customers': urlBase = `/api/customer/${response.data.customer_id}`; break;
        case'commercial': urlBase = `/api/commercial-schedule/${response}`; break;
    }
    return urlBase
}
function modal_changes(element,token,model){
    if (isValidElement(document.querySelector("#serviceId")))var service_id = document.querySelector("#serviceId").innerText
    if(isValidElement(document.querySelector("#scheduleId"))) var schedule_id = document.querySelector("#scheduleId").innerText
    // let schedule_id = document.querySelector("#scheduleId").innerText
    switch (model) {
        case'services': field_change(element,urlGenerate(model,service_id),token); break;
        case'employees':
        case'customers':
                axios.get('/api/services/'+service_id+'/all:id,customer_id,employee1_id')
                    .then(resp=>{
                        // console.info(resp)
                        field_change(element,urlGenerate(model,resp),token)
                    })
            break;
        case'commercial':
            axios.get('/api/commercial-schedule/'+schedule_id+'/all:id,customer_id,employee1_id')
                .then(resp=>{
                    // console.info(resp)
                    field_change(element,urlGenerate(model,resp),token)
                })
    }
    console.log("função modal_change service_id =>"+service_id)
}

function dateTime_change(elementId1,elementId2,token,model){
    const date = document.getElementById(elementId1).value
    const time = document.getElementById(elementId2).value
    const service_id = document.querySelector("#serviceId").innerText
    //element.getAttribute('value')
    let value = `${date} ${time}`
    const urlBase = `/api/services/${service_id}`
    // console.log('alterando campo service_date Via axios com valor => '+value)
    // console.log("url => "+urlBase)
    // console.log("date=>"+date+" Time=>"+time)
    const DateToPost = moment(date+" "+time, "MM/DD/YYYY hh:mm").format("YYYY-MM-DD hh:mm:ss")
    // console.log("fotmated ->"+DateToPost)
    axios.patch(urlBase,
        {
            _token: token,
            fieldName: "service_date",
            value: DateToPost,
        }).then(resp =>{
                // console.log(resp)
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
    axios.post('/api/update-billing/'+customerId,
        dataJson
        ).then(function (response) {
            console.log(response)
            toastAlert.fire({
                icon: "success",
                title: `The billing is successfully updated!`
            });

        }
    )
}

// confirm or not service
function startConfirmation(){
        let btnConfirm = document.querySelectorAll('.btn-confirm-form')
        console.log(btnConfirm)

        for (let i = 0; i < btnConfirm.length; i++) {
            btnConfirm[i].addEventListener('click',function (event) {
                event.preventDefault()
                    let dataJson = {

                        '_token': this.dataset.token,
                        'id': this.dataset.serviceId,
                        'numWeek': this.dataset.numWeek,
                        'confirmed': this.dataset.confirmed,

                    }
                    //console.log(dataJson)
                axios.post(' api/confirm',
                    dataJson
                ).then(function (response) {
                    //console.log(response.data.html)
                    document.getElementById('htmlContent').innerHTML = response.data.html
                    toastAlert.fire({
                        icon: "success",
                        title: response.data.message
                    });
                    startConfirmation()
                })


            })

        }
}
startConfirmation()

let ChangeResidentialModalFields = document.querySelectorAll('.modal-residential-change')


    ChangeResidentialModalFields.forEach(function (el) {
        el.addEventListener('change',function (ev) {
            console.log('change event')
            switch (this.getAttribute('name')) {
                case'service_date':console.log('date');
                case'service_time':console.log('time');dateTime_change('serviceDate','serviceTime',this.dataset.token)  ;break;
                default:console.log('default');modal_changes(this,this.dataset.token,this.dataset.dbModel );
            }
        })
    })

function initModalLinks(){
    let modalLinks = document.querySelectorAll('.link-modal-residential')
    console.log(modalLinks.length)
    if (modalLinks.length > 0){
        modalLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                push_run(this)
            })
        })
    }
}


function listenerDeleteBtn(){
    let btnDeleteService = document.querySelector('#btnDeleteService')

    if(isValidElement(btnDeleteService)){
        btnDeleteService.addEventListener('click',function (event){
            event.preventDefault()
            //alert(urlGenerate('services',this.dataset.serviceId))
            swalConfirmCallback(
                'did you actually wish delete this schedule ?',
                'Yes',
                ()=> {
                    axios.delete(urlGenerate('services',this.dataset.serviceId)).then(
                        function (response) {
                            console.log(response.data.html)
                            document.getElementById('htmlContent').innerHTML = response.data.html
                            M.Modal.getInstance(document.getElementById('largeModal')).close()
                            toastAlert.fire({
                                icon: "success",
                                title: response.data.message
                            });
                            listenerDeleteBtn()
                            startConfirmation()
                            initModalLinks()
                        }
                    )

                }
            )

        })
    }
}
listenerDeleteBtn()
