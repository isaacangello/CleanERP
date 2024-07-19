const pluginPath = '../helpers'
import {isNullOrUndef} from  '../helpers/funcs.js';
import {isValidElement} from "../helpers/funcs.js";

let scheduleForm =  document.getElementById('schedule-form')
console.log(scheduleForm)
if(isValidElement(scheduleForm)){
    scheduleForm.addEventListener('submit',function (event){
        event.preventDefault()

    })
}