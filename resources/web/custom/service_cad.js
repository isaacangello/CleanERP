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


}


