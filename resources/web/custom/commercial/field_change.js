import {isValidElement,isNullOrUndef,serialize,errorShow} from "../helpers/funcs.js";
import {initModalLinksCom} from './modalPush.js'
function urlGenerate(model,parameter){
    var urlBase = "";
    switch (model) {
        case'schedule':
        case'commercial': urlBase = `/api/commercial-schedule/${parameter}`; break;
        case'employees': urlBase = `/api/employee/${parameter}` ; break;
        case'customers': urlBase = `/api/customer/${parameter}`; break;
        case'schedule.delete':
        case'commercial.delete':
            urlBase = `/api/commercial-schedule/delete`; break
        case'schedule.query':
        case'commercial.query': urlBase = `/api/commercial-schedule/${parameter}`; break;
    }
    return urlBase
}

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
function modal_changes(element,token,model){
    if(isValidElement(document.querySelector("#scheduleId"))) var schedule_id = document.querySelector("#scheduleId").innerText
    // let schedule_id = document.querySelector("#scheduleId").innerText
    switch (model) {
        case'schedule': field_change(element,urlGenerate(model,schedule_id),token); break;
        case'employees':
            axios.get(urlGenerate('schedule',schedule_id+'/all:id,customer_id,employee_id'))
                .then(resp=>{
                    // console.info(resp)
                    field_change(element,urlGenerate(model,resp.data.employee1_id),token)
                })
            break;
        case'customers':
                axios.get(urlGenerate('schedule',schedule_id+'/all:id,customer_id,employee_id'))
                    .then(resp=>{
                        // console.info(resp)
                        field_change(element,urlGenerate(model,resp.data.customer_id),token)
                    })
            break;
        case'commercial.query':
            axios.get(urlGenerate('commercial.query',schedule_id+'/all:id,customer_id,employee_id'))
                .then(resp=>{
                    // console.info(resp)
                    field_change(element,urlGenerate(model,resp),token)
                })
    }
    console.log("função modal_change schedule_id =>"+schedule_id)
}

function dateTime_change(elementId1,elementId2,token,model){
    const date = document.getElementById(elementId1).value
    const time = document.getElementById(elementId2).value
    const schedule_id = document.querySelector("#scheduleId").innerText
    //element.getAttribute('value')
    let value = `${date} ${time}`
    const urlBase = urlGenerate('schedule',schedule_id)
    // console.log('alterando campo service_date Via axios com valor => '+value)
     console.log("url => "+urlBase)
     console.log("date=>"+date+" Time=>"+time)
    const DateToPost = moment(date+" "+time, "MM/DD/YYYY HH:mm").format("YYYY-MM-DD HH:mm:ss")
    console.log("fotmated ->"+DateToPost)
    axios.patch(urlBase,
        {
            _token: token,
            fieldName: "schedule_date",
            value: DateToPost,
        }).then(resp =>{
                // console.log(resp)
                swalConfirm("field date or time" )
            }

        ).catch( resp =>{

            console.log(resp)
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
        //console.log(btnConfirm)

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
                    console.log(response)
                    // document.getElementById('htmlContent').innerHTML = response.data.html
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

let ChangeCommercialModalFields = document.querySelectorAll('.modal-commercial-change')

ChangeCommercialModalFields.forEach(function (el) {
    el.addEventListener('change',function (ev) {
        console.log('change event')
        switch (this.getAttribute('name')) {
            case'schedule_date':console.log('date');
            case'schedule_time':console.log('date');
            case'schedulePeriod':console.log('time');dateTime_change('scheduleDate','schedulePeriod',this.dataset.token)  ;break;
            default:console.log('default');modal_changes(this,this.dataset.token,this.dataset.dbModel );
        }
    })
})



function listenerDeleteBtn(){
    let btnDelete = document.querySelector('#btnDelete')
    console.log('Listener btn commercial')
    if(isValidElement(btnDelete)){
        btnDelete.addEventListener('click',function (event){
            event.preventDefault()
            //alert(urlGenerate('services',this.dataset.serviceId))
            swalConfirmCallback(
                'did you actually wish delete this schedule ?',
                'Yes',
                ()=> {
                    console.log(urlGenerate('schedule.delete',this.dataset.scheduleId))
                    let jsonData = {
                        _token: this.dataset.token,
                        id: this.dataset.scheduleId,
                        nunWeek:  this.dataset.nunWeek,
                        year:  this.dataset.year

                    }
                    axios.post(urlGenerate('schedule.delete',this.dataset.scheduleId),jsonData)
                        .then(
                                function (response) {
                                     console.log(response)
                                    document.getElementById('renderSchedule').innerHTML = response.data.html
                                    M.Modal.getInstance(document.getElementById('scheduleModal')).close()
                                    toastAlert.fire({
                                        icon: "success",
                                        title: response.data.message
                                    });
                                    listenerDeleteBtn()
                                    initModalLinksCom()
                                }
                       )

                }
            )

        })
    }
}
listenerDeleteBtn()

// let btnDelete = document.querySelector('#btnDelete')
// if(isValidElement(btnDelete)){
//     btnDelete.addEventListener('click',function (event){
//         event.preventDefault()
//         swalConfirmCallback(
//             'did you actually wish delete this schedule ?',
//             'Yes',
//             ()=> {
//                 axios.delete(urlGenerate('schedule',this.dataset.scheduleId)).then(
//                     function (response) {
//                         console.log(response)
//                     }
//                 )
//             }
//         )
//
//     })
// }


