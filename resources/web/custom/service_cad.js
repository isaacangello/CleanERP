import {isValidElement,isNullOrUndef,serialize,errorShow} from "./helpers/funcs.js";


function price_inject() {
    let selectCust = document.querySelector('#select-cad-service-customer')
    let idCust = selectCust.options[selectCust.selectedIndex].value
    axios.get('api/customer/'+idCust)
        .then(function (resp) {
            // let payments = document.querySelector(idPush)
             // var instance = M.FormSelect.getInstance(payments);
            let SelectContainer = document.getElementById('select-cad-service-billings-container')
            //instance.destroy()
            // console.log(instance.dropdownOptions.children[0])
            console.log(resp.data)
            // console.log(instance.dropdownOptions)
            // console.log(instance.options)
            let SelectBillings = document.createElement('select')
            SelectBillings.setAttribute('class','materialize-select')
            SelectBillings.setAttribute('id','select-cad-service-billings')
            SelectBillings.setAttribute('name','frequency_payment')
        for(let i=0;i<resp.data.billings.length;i++){
            // console.log(payments.options[i].value)
            console.log(resp.data.billings[i].label)
                    SelectBillings.appendChild(new Option(`${resp.data.billings[i].label} / US$ ${resp.data.billings[i].value}`,`${resp.data.billings[i].id},${resp.data.billings[i].value}`)) //= resp.data.billings[i].label+" / R$" + resp.data.billings[i].value
                    // payments.options[i].innerText = resp.data.billings[i].label+" / R$" + resp.data.billings[i].value

                    //li1.innerHTML = "<span> Eventual /  R$"+resp.data.price_weekly+"</span>"
            // payments.options[i].innerText = payments.options[i].text
            // console.log(payments.options[i].text)
        }
            SelectContainer.innerHTML = ''
            SelectContainer.appendChild(SelectBillings)
            let element = document.getElementById('select-cad-service-billings')
            M.FormSelect.init(element)

        })


}// funçao price_inject

// ouvindo mudanças no formulario de cadastro
document.querySelector('#select-cad-service-customer').addEventListener('change',function () {
    price_inject()
})

// logic async for modal to register services

let ServiceForm = document.querySelector('#service-form')

if (isValidElement(ServiceForm)){
ServiceForm.addEventListener('submit',function (event) {
    event.preventDefault()

    let data = new FormData(this)
    let dataJson = {

        '_token': data.get('_token') ,
        'who_saved': data.get('who_saved'),
        'who_saved_id': data.get('who_saved_id'),
        'numWeek': data.get('numWeek'),
        'customer_id': data.get('customer_id'),
        'employee1_id': data.get('employee1_id'),
        'employee2_id': data.get('employee2_id'),
        'service_date': data.get('service_date'),
        'service_time': data.get('service_time'),
        'period': data.get('period'),
        'frequency_payment': data.get('frequency_payment'),
        'frequency': data.get('frequency'),
        'notes': data.get('notes'),
        'instructions': data.get('instructions'),
    }
    console.log(dataJson)
    axios.post('api/services', dataJson)
        .then(function (resp) {
            console.log("status retornado => "+resp.status)
            console.info(resp.data.message)
            console.info(resp)
            // repopulate screen
            document.querySelector("#htmlContent").innerHTML = resp.data.html
            // get instance of modal and close it
            let serviceCadModalElement = document.getElementById('new-service')
            let serviceCadModalInstance = M.Modal.getInstance(serviceCadModalElement)
            serviceCadModalInstance.close()
            toastAlert.fire({
                icon: "success",
                title: resp.data.message
            });

        })
        .catch(function (error) {
            let infoBox = document.querySelector('#error_infobox')
            let boxMsgError = document.querySelector('#error-text')
            boxMsgError.style.fontSize = '18px'
            boxMsgError.innerText = " "+error.response.data.message;
            console.info(infoBox.classList)
            if(infoBox.classList.contains('hide')){
            infoBox.classList.remove('hide')
            }

            console.log(error)
        })

})

}