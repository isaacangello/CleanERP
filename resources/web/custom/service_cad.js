// import axios  from "axios";
function price_inject(idPush) {
    let selectCust = document.querySelector('#select-cad-service-customer')
    let idCust = selectCust.options[selectCust.selectedIndex].value
    axios.get('api/customer/'+idCust)
        .then(function (resp) {
            let payments = document.querySelector(idPush)
             var instance = M.FormSelect.getInstance(payments);
            // console.log(instance.dropdownOptions.children[0])
            // console.log(resp.data)
        for(i=0;i<payments.options.length;i++){
            // console.log(payments.options[i].value)

            switch(payments.options[i].value) {
                case "One":
                // console.log("SWITCH EVENTUAL");
                    payments.options[i].innerText = "Eventual / R$" + resp.data.price_weekly
                    let li1 = document.querySelector('#'+instance.dropdownOptions.children[i].id)
                    li1.innerHTML = "<span> Eventual /  R$"+resp.data.price_weekly+"</span>"
                     break;
                case "Wek":
                    // console.log("Switch opçao Weekly");
                    payments.options[i].innerText = "Weekly / R$" + resp.data.price_weekly
                    let li2 = document.querySelector('#'+instance.dropdownOptions.children[i].id)
                    li2.innerHTML = "<span> Weekly /  R$"+resp.data.price_weekly+"</span>"
                     break;
                case "Biw":
                    // console.log("Switch opçao Biweekly");
                    payments.options[i].innerText = "Biweekly / R$" + resp.data.price_biweekly
                    let li3 = document.querySelector('#'+instance.dropdownOptions.children[i].id)
                    li3.innerHTML = "<span> Biweekly /  R$"+resp.data.price_biweekly+"</span>"
                     break;
                case "Mon":
                    // console.log("Switch opçao Monthly");
                    payments.options[i].innerText = "Monthly / R$" + resp.data.price_monthly
                    let li4 = document.querySelector('#'+instance.dropdownOptions.children[i].id)
                    li4.innerHTML = "<span> Monthly /  R$"+resp.data.price_monthly+"</span>"

                     break;
            }
            // payments.options[i].innerText = payments.options[i].text
            // console.log(payments.options[i].text)
        }


        })


}// funçao price_inject


// logic async for modal to register services

const ServiceForm = document.querySelector('#service-form')

if (ServiceForm !== undefined){
ServiceForm.addEventListener('submit',function (event) {
    event.preventDefault()
    function RefreshPage(key,queryString) {
        var newUrl = window.location.origin + window.location.pathname + "?"+key+"=" + queryString;
        window.location.href = newUrl;
        return false;
    }
    let data = new FormData(this)
    let dataJson = {

        '_token': data.get('_token') ,
        'who_saved': data.get('who_saved'),
        'who_saved_id': data.get('who_saved_id'),
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
    axios.post('api/services', dataJson)
        .then(function (resp) {
            console.log("status retornado => "+resp.status)
            console.info(resp.data.message)
            sessionStorage.setItem('status','service-true')
            sessionStorage.setItem('msg',resp.data.message)
            RefreshPage('msg',resp.data.message)
            // window.location.reload()
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