
import {date_format, isValidElement, time_format} from './helpers/funcs.js'
function push_run(btnParam){

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
            const deleteBtn = document.querySelectorAll('.btnDeleteService');
            const feeBtn = document.querySelectorAll('.btnFeeService');
        deleteBtn.forEach(function (e) {
            e.dataset.serviceId = id
        })
        feeBtn.forEach(function (e) {
            e.dataset.serviceId = id
        })
        /**
         *  control fee algorithm
         */
        document.getElementById('idToFee').value = id

        /**
         *  api/services/{service} route to det data
         * */
        function markSelected(itemId,itemSearch){
            let item = document.querySelector(itemId)
            let itemInstance = M.FormSelect.getInstance(item)
            console.info()
            if(isValidElement(itemInstance)){
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
            }else{
                item.options[item.options.selectedIndex].removeAttribute("selected")
                for(var i=0;i<item.options.length;i++){
                    // console.log(item.options[i].value)
                    if (item.options[i].innerText === itemSearch){
                        item.options[i].setAttribute("selected", "selected")

                    }
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
                    // let selectEmp = document.querySelector("#selectServiceEmployee")
                    // let selectCust = document.querySelector("#selectServiceCustomer")
                    serviceAddress.value = serviceData.customer.address
                    servicePhone.value = serviceData.customer.phone
                        flatpickr( '#serviceDate',     {
                        weekNumbers:true,
                        monthSelectorType:'static',
                        dateFormat:'Y-m-d',
                        altFormat:'F j, Y',
                        altInput:true,
                        defaultDate:`${serviceData.service_date}`
                    })

                flatpickr( '#serviceTime',    {
                    enableTime: true,
                        noCalendar: true,
                    dateFormat: 'H:i:S' ,
                    altFormat:'h:i K',
                    altInput:true,
                    defaultDate:`${serviceData.service_date}`
                })

                    // serviceDate.value = date_format(serviceData.service_date)
                    // serviceTime.value = time_format(serviceData.service_date)
                    console.log(serviceData.control)
                    if(serviceData.control !== null){
                        serviceInTime.value = time_format(serviceData.control.checkin_datetime)
                        serviceOutTime.value  = time_format(serviceData.control.checkout_datetime)
                    }
                    serviceInformation.innerText = " "
                    ServiceNotes.innerText = serviceData.notes
                    ServiceInstructions.innerText = serviceData.instructions
                }
            )
        return ""
    }
    //console.log(service_id)
    populate(service_id)
}

//'onclick' => "push_run(this)",
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

initModalLinks()

export {push_run};