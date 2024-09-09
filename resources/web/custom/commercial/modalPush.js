import {date_format,time_format} from '../helpers/funcs.js'
function schedule_push(btnParam){

    const btnModalId = btnParam.getAttribute('href')
    const modalInstanceCom = M.Modal.getInstance(document.querySelector(btnModalId))
    const schedule_id = btnParam.getAttribute('data-schedule-id')

    document.querySelector("#scheduleId").innerText = schedule_id
    console.info(modalInstanceCom)
    function populate(id)  {
        /**
         * Flied
         */

        const defaultModalLabel = document.querySelector("#defaultModalLabel")
        const scheduleAddress = document.querySelector("#scheduleAddress")
        const schedulePhone= document.querySelector("#schedulePhone")
        const scheduleDate= document.querySelector("#scheduleDate")
        const schedulePeriod= document.querySelector("#schedulePeriod")
        const scheduleInTime= document.querySelector("#scheduleInTime")
        const scheduleOutTime= document.querySelector("#scheduleOutTime")
        const scheduleInformation= document.querySelector("#scheduleInformation")
        const scheduleNotes= document.querySelector("#scheduleNotes")
        const scheduleInstructions= document.querySelector("#scheduleInstructions")
        /**
         *  api/commercial-schedule/{id} route to det data
         * */

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
        axios.get("/api/commercial-schedule/"+id)
            .then(response=>{
                    console.log(response)
                    let scheduleData = response.data
                    console.log("Axios reponse ====>>>>"+scheduleData)

                        defaultModalLabel.innerText = scheduleData.customer.name
                    markSelected("#selectscheduleEmployee",scheduleData.employee.name)
                    markSelected("#selectscheduleCustomer",scheduleData.customer.name)
                    scheduleAddress.value = scheduleData.customer.address
                    schedulePhone.value = scheduleData.customer.phone
                    scheduleDate.value = date_format(scheduleData.schedule_date)
                    if(moment(scheduleData.schedule_date).format('H')>0 && moment(scheduleData.schedule_date).format('H')<12 ){
                        schedulePeriod.value = "First"
                    }
                    if(moment(scheduleData.schedule_date).format('H')>=12 && moment(scheduleData.schedule_date).format('H')<18 ){
                        schedulePeriod.value = "Second"
                    }
                    if(moment(scheduleData.schedule_date).format('H')>=12 && moment(scheduleData.schedule_date).format('H')<18 ){
                        schedulePeriod.value = "Third"
                    }

                    scheduleInTime.value = time_format(scheduleData.control.checkin_datetime)
                    scheduleOutTime.value  = time_format(scheduleData.control.checkout_datetime)
                    scheduleInformation.innerText = " "
                    scheduleNotes.innerText = scheduleData.notes
                    scheduleInstructions.innerText = scheduleData.instructions
                }

            )
        return true
    }
    console.log(schedule_id)
    modalInstanceCom.onOpenStart(populate(schedule_id))
    populate(schedule_id)
}

let modalLinksCom = document.querySelectorAll('.link-modal-commercial')
console.log(modalLinksCom.length)
if (modalLinksCom.length > 0) {
    modalLinksCom.forEach(function (link) {
        link.addEventListener('click', function () {
            schedule_push(this);
        })
    })
}