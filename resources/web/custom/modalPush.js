function push_run(btnParam,custId,empId){

    const btnModalId = btnParam.getAttribute('href')
    const modalInstance = M.Modal.getInstance(document.querySelector(btnModalId))
    const service_id = btnParam.getAttribute('data-service-id')

    document.querySelector("#serviceId").innerText = service_id
    console.info(modalInstance)
    function populate(id)  {
        /**
         * Flied
         */

            const defaultModalLabel = document.querySelector("#defaultModalLabel")
            const serviceAddress = document.querySelector("#serviceAddress")
            const servicePhone= document.querySelector("#servicePhone")
            const serviceDate= document.querySelector("#serviceDate")
            const serviceTime= document.querySelector("#serviceTime")
            const serviceInTime= document.querySelector("#serviceInTime")
            const serviceOutTime= document.querySelector("#serviceOutTime")
            const serviceInformation= document.querySelector("#serviceInformation")
            const ServiceNotes= document.querySelector("#ServiceNotes")
            const ServiceInstructions= document.querySelector("#ServiceInstructions")
        /**
         *  api/services/{service} route to det data
         * */
        function date_format(dataInput) {
            data = new Date(dataInput);
            return data.toLocaleDateString('en-US', {timeZone: 'UTC'});
        }
        function time_format(timeInput) {
            let convert = { '13':"01",'14':"02",'15':"02",'16':"04",'17':"05",'18':"06",'19':"07",'20':"08",'21':"09",'22':"10",'23':"11"}
            let time_temp = timeInput.split(':')
            let sufix = 'AM';
                if ( time_temp[0] > 12 ){
                    return convert[time_temp[0]]+":"+time_temp[1]+' PM'

                }else{
                    return time_temp[0]+":"+time_temp[1]+' AM'
                }
        }
        function markSelected(itemId,itemSearch){
            let item = document.querySelector(itemId)
            let itemInstance = M.FormSelect.getInstance(item)
            console.info(itemInstance)
            itemInstance.input.value = itemSearch
            for(var c = 0; c< itemInstance.dropdownOptions.children.length;c++){
                //console.info(itemSearch)
                if(itemInstance.dropdownOptions.children[c].classList.contains("selected")){
                    let l1 = document.querySelector('#'+itemInstance.dropdownOptions.children[c].id)
                    l1.classList.remove("selected")
                }
                if (itemInstance.dropdownOptions.children[c].innerText === itemSearch){
                    let l1 = document.querySelector('#'+itemInstance.dropdownOptions.children[c].id)
                    l1.classList.add("selected")
                }
            }
        }
        axios.get("api/services/"+id)
            .then(response=>{
                     console.info(response.data)
                    let serviceData = response.data
                    if(serviceData.customer.type === "RENTALHOUSE"){
                        defaultModalLabel.innerHTML = serviceData.customer.name+' <span class="material-symbols-outlined ">brightness_7</span>'
                    }else{
                        defaultModalLabel.innerText = serviceData.customer.name
                    }
                    markSelected("#selectServiceEmployee",serviceData.employee.name)
                    markSelected("#selectServiceCustomer",serviceData.customer.name)
                    serviceAddress.value = serviceData.customer.address
                    servicePhone.value = serviceData.customer.phone
                    serviceDate.value = date_format(serviceData.service_date.split()[0])
                    serviceTime.value = time_format(serviceData.service_date.split(' ')[1])
                    serviceInTime.value = " "
                    serviceOutTime.value  = " "
                    serviceInformation.innerText = " "
                    ServiceNotes.innerText = serviceData.notes
                    ServiceInstructions.innerText = serviceData.instructions
                }
            )
        return ""
    }
    console.log(service_id)
    modalInstance.onOpenStart(populate(service_id))
}