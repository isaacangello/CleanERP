const pluginPath = '../helpers'
// import {isNullOrUndef} from  '../helpers/funcs.js';
import {isValidElement,isNullOrUndef,serialize,errorShow} from "../helpers/funcs.js";


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
            'denomination': dataForm.get('denomination'),
            'employee1_id': dataForm.get('employee1_id'),
            'schedule_date': dataForm.get('schedule_date'),
            'schedule_time': dataForm.get('schedule_time'),
            'period': dataForm.get('period'),
            'loop': dataForm.getAll('loop[]'),
            'notes': dataForm.get('notes'),
            'instructions': dataForm.get('instructions'),
        }
        axios.post('  api/commercial-schedule',jsonData)
            .then(function (response) {
                //console.log(response)
                axios.get('api/commercial-schedule')
                    .then(function (resp) {
                        console.log(resp)
                            document.getElementById('renderSchedule').innerHTML = resp.data.cards
                         var elem = document.querySelector('#new-schedule')
                        var instance = M.Modal.getInstance(elem);
                        instance.close()
                        }
                    )
            }).catch(function (error) {
            let errorBox =  document.getElementById('error_infobox')
            let errorInnexText = document.getElementById('error-text')
             console.log(error)
            errorShow(error,errorBox,errorInnexText,'cad-schedule-')
        })
    })
}