const pluginPath = '../helpers'
// import {isNullOrUndef} from  '../helpers/funcs.js';
import {isValidElement,isNullOrUndef,serialize} from "../helpers/funcs.js";


let scheduleForm =  document.getElementById('schedule-form')
console.log(scheduleForm)
if(isValidElement(scheduleForm)){
    scheduleForm.addEventListener('submit',function (event){
        event.preventDefault()
        let dataForm = new FormData(scheduleForm)
        let jsonData = {
            '_token': dataForm.get('_token'),
            'who_saved': dataForm.get('who_saved'),
            'who_saved_id': dataForm.get('who_saved_id'),
            'customer_id': dataForm.get('customer_id'),
            'employee1_id': dataForm.get('employee1_id'),
            'service_date': dataForm.get('service_date'),
            'service_time': dataForm.get('service_time'),
            'period': dataForm.get('period'),
            'loop': dataForm.getAll('loop[]'),
            'notes': dataForm.get('notes'),
            'instructions': dataForm.get('instructions'),
        }
        axios.post('  api/commercial-schedule',jsonData)
            .then(function (response) {
                console.log(response)
            })
    })
}