/*jshint esversion: 6 */

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import 'sweetalert2/dist/sweetalert2.min.css';
import '../css/app.css';
import axios from "axios";
// import '../css/cleopatra.css'
// import '../fa6/pro/css/all.css';
import '../fa6/pro/js/all.js';
import 'animate.css';
import flatpickr from "flatpickr";
import 'flatpickr/dist/flatpickr.css'
import 'flowbite';
import {toastAlert,Toast_5000,swalConfirmCallback,swalConfirm} from "./custom/helpers/plugins_init.js";
import {isValidElement} from "./custom/helpers/funcs.js";


    window.customEvents = function () {

        Livewire.on('toggle-status-service',function (event) {
            axios.post('/api/confirm-only/'+event.id,
                {
                    id: event.id
                }
            ).then(function (resp) {
                console.log(resp.data)
                let icon;
                let btn =document.querySelector("#el-"+event.id)
                if(resp.data.confirmed === 1){
                    icon =  'success'
                    // 'text-blue-700' : 'text-red-700'
                    btn.classList.remove('text-red-700')
                    btn.classList.add('text-blue-700')
                }else {
                    icon =  'error'
                    btn.classList.remove('text-blue-700')
                    btn.classList.add('text-red-700')
                }



                toastAlert.fire({
                    icon: icon,
                    title: resp.data.message,
                })

            }).catch(function (error) {
                console.error(error)
            })
        })

        Livewire.on('wire-toast-alert', (event) => {
            toastAlert.fire({
                icon: event.detail.icon,
                title: event.detail.message
            });
        })
        window.addEventListener('toast-alert', event =>{
            // console.log(event)
            toastAlert.fire({
                icon: event.detail.icon,
                title: event.detail.message
            })
            console.log(window)
        })

        window.addEventListener('toggleDisabledBtnDelete', event =>{
            let btnElements = document.querySelectorAll('.btn-delete')

            btnElements.forEach(eL =>{
                console.log(eL)
                eL.classList.toggle('disabled')
            })
        })
        window.addEventListener('enableBtnDelete', event =>{

            let btnElements = document.querySelectorAll('.btn-delete')

            btnElements.forEach(eL =>{
                console.log(eL)
                if(eL.classList.contains('disabled')){
                    eL.classList.remove('disabled')
                }else{

                }

            })


        })
        window.addEventListener('disabledBtnDelete', event =>{

            let btnElements = document.querySelectorAll('.btn-delete')

            btnElements.forEach(eL => {
                console.log(eL)
                if (eL.classList.contains('disabled')) {
                } else {
                    eL.classList.add('disabled')
                }

            })

        })
        window.addEventListener('triggerRestoreBilling', function (event){

            swalConfirmCallback('Do you want to restore this record?','Yes?', ()=> {
                window.Livewire.dispatch('restoreBilling',{id:event.detail.id})
            })
        })
        window.addEventListener('populate-date', event=>{
            flatpickr( event.detail.idElement,     {
                weekNumbers:true,
                monthSelectorType:'dropdown',
                dateFormat:'Y-m-d',
                altFormat:'F j, Y',
                altInput:true,
                defaultDate:`${event.detail.date}`
            })

        })
        window.addEventListener('populate-time', event=>{
            flatpickr( event.detail.idElement,
                {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: 'H:i',
                    altFormat: 'h:i K',
                    altInput: true,
                    defaultDate: `${event.detail.time}`

                }
            )

        })
        window.addEventListener('populate-date-time', event=>{
            if(event.detail.dateTime){
                flatpickr( event.detail.idElement,
                    {
                        weekNumbers:true,
                        monthSelectorType:'dropdown',
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        altFormat: 'F j, Y h:i K',
                        altInput: true,
                        // onChange: function(selectedDates, dateStr, instance){
                        //     if (dateStr)
                        //         instance.close();
                        // },
                        defaultDate: `${event.detail.dateTime}`

                    }
                )
            }else{
                flatpickr( event.detail.idElement,
                    {
                        weekNumbers:true,
                        monthSelectorType:'dropdown',
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        altFormat: 'F j, Y h:i K',
                        altInput: true,
                        // onChange: function(selectedDates, dateStr, instance){
                        //     if (dateStr)
                        //         instance.close();
                        // },

                    }
                )
            }

        })
        document.addEventListener('select-cad-employee', event => {
            var week;
            // console.log(Livewire.getByName('residential.week'))
            var selectElement = document.querySelector('#select-cad-service-employee1')
            if (selectElement) {
                for (let i = 0; i < selectElement.options.length; i++) {
                         if(selectElement.options[i].value === event.detail.empId){
                             selectElement.options[i].selected = true
                             console.log(`Option ${i + 1}: Value = ${selectElement.options[i].value}, Text = ${selectElement.options[i].text}`);
                         }

                }
            } else {
                console.error("Select element with ID 'mySelect' not found.");
            }
            Livewire.all().forEach(value => {
                if(value.name === "residential.week"){
                    console.log(value)
                    Livewire.dispatch('populate-on-open',{'empId':event.detail.empId,'date':event.detail.dateTime})


                }
            })
            flatpickr( "#input-cad-service-date",
                {
                    weekNumbers:true,
                    monthSelectorType:'dropdown',
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    altFormat: 'F j, Y h:i K',
                    altInput: true,
                    // onChange: function(selectedDates, dateStr, instance){
                    //     if (dateStr)
                    //         instance.close();
                    // },
                    defaultDate: `${event.detail.dateTime}`

                }
            )


        });
        document.addEventListener('select-all-checkboxes', event => {
            console.log("select-all-checkboxes:  ".event)
            const checkboxClass = event.detail.checkboxClass;
            const checkboxes = document.querySelectorAll(`.${checkboxClass}`);
            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);

            checkboxes.forEach(checkbox => {
                checkbox.checked = !allChecked;
            });
        });
        window.addEventListener('trigger-confirm-fee', function (event){
            // console.log("event fee")
            // console.log($wire)
            swalConfirmCallback('Do you want to change fee status?','Yes?', ()=> {
                window.Livewire.dispatch('toggle-fee')
            })
        })
        window.addEventListener('trigger-cancel-fee', function (event){
            console.log("event cancel fee")
            swalConfirmCallback('Do you want to change fee status?','Yes?', ()=> {
                window.Livewire.dispatch('cancel-fee', {id:event.detail.id})
            })


        })
        window.addEventListener('trigger-confirm-delete', function (event){
            swalConfirmCallback('Do you want to delete this record?','Yes?', ()=> {
                window.Livewire.dispatch('delete-service')
            })
        })

    }
    function modalInit(btnElement,btnClose,id1element,options = {}) {
        if(isValidElement(id1element)){
            let htmlEl1 = document.getElementById(id1element)
            let instance = new Modal(htmlEl1, options);
            let elBtn = document.getElementById(btnElement)
            let elClose = document.getElementById(btnClose)
            let elClose1 = document.getElementById(btnClose+"1")
            elBtn.addEventListener('click',function (event) {
                instance.show()
            })
            elClose.addEventListener('click',function (event) {
                instance.hide()
            })
            elClose1.addEventListener('click',function (event) {
                instance.hide()
            })
        }else{
            console.error("Elemento id not found")
            return "Elemento id not found";
        }


    }
    Alpine.data('cnf', () => ({
        show: false,
        leftSideBar: true,
        profileDropDown: false,
        notifications: false,
        messages: false,

        toggle() {
            this.show = !this.show;
        },
        toggleLeftSideBar() {
            this.leftSideBar = !this.leftSideBar;
            this.$refs.mainContent.classList.toggle('md:ml-64');

        },
        sidebarInit(el1) {
                const navBar = document.getElementById('navBar');
                const leftSideBar = document.getElementById('leftSideBar');
                console.log("adjust margin top",navBar.offsetHeight);
                leftSideBar.style.marginTop = navBar.offsetHeight + 'px';
                // leftSideBar.classList.add('overflow-y-auto')

        },

        pageInit(pt = 30){

                document.getElementById('gifLoading').style.display = 'none';

                // document.getElementById('contentHidden').style.display = 'block';
                const navBar = document.getElementById('navBar');
                const mainContent = document.getElementById('mainContent');
                const mTop = navBar.offsetHeight + pt;

        },

    }));
    Alpine.data('loginInit', () => ({

        pageInit(){
            document.getElementById('gifLoading').style.display = 'none';
            // document.getElementById('contentHidden').style.display = 'block';
            console.log(window);

        },
        startAlpine(){
            console.log('login init')
        },
        toastAlert(message="message",timeout =3000,options = {},type='swl'){
            if(type === 'swl') {
                toastAlert.fire({
                    title: message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: timeout
                });

            }

        }

    }));


    Alpine.data('weekScreen', () => ({
        'cadOpen': Livewire.all()[0].$wire.entangle('showCadModal').live,
        'open': Livewire.all()[0].$wire.entangle('showModal').live,
        init(){
                // let weekComponent = Livewire.getByName("residential.week")
                console.log(Livewire.all())
                // console.log(Livewire.all()[0].ephemeral.from)
                // console.log(weekComponent[0].get('tempDate'))
                //modalInit('btnNew','modalClose','modal-create',{placement:'center-center'})
               window.customEvents()
        },
        showModal(){
            this.open = true
        },
        openModal(){
            console.log('open modal')
            var week  = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']
            var now = new Date()
            var dayTemp= now.getFullYear() + "-" + now.getMonth() + "-" + now.getDate()
            // window.Livewire.dispatch('populate-date-time', {idElement: "#input-cad-service-date", dateTime: dayTemp})
            flatpickr( "#input-cad-service-date",
                {
                    weekNumbers:true,
                    monthSelectorType:'dropdown',
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    altFormat: 'F j, Y h:i K',
                    altInput: true,
                    // onChange: function(selectedDates, dateStr, instance){
                    //     if (dateStr)
                    //         instance.close();
                    // },
                    defaultDate: `${dayTemp}`

                }
            )

            this.cadOpen = true
        },
        closeModal(){

            this.cadOpen = false
            return true
        },
        focusables() {
        let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
        return [...$el.querySelectorAll(selector)]
            .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 }
    }))
    // console.log(Livewire)
    Alpine.data('searchScreen',()=>({
        init(){
           window.customEvents()
            console.log(Livewire.all())

        },
            tabService: true,
            tabRepeat: false,
            tabCustomer: false,
            tabEmployee: false,
            // tabService: this.$wire.entangle('tabService'),
            // 'tabRepeat': $wire.entangle('tabRepeat'),
            // 'tabCustomer': $wire.entangle('tabCustomer'),
            // tabEmployee: $wire.entangle('tabEmployee'),
            selectTab(selected) {
            switch (selected) {
                case 'tabService':
                    console.log('Service');
                    this.$refs.tabServiceElement.classList.remove( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');
                    this.$refs.tabServiceElement.classList.add( 'active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500' );

                    this.$refs.tabRepeatElement.classList.remove('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');
                    this.$refs.tabRepeatElement.classList.add( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');

                    this.$refs.tabCustomerElement.classList.remove('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');
                    this.$refs.tabCustomerElement.classList.add( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');

                    this.$refs.tabEmployeeElement.classList.remove('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');
                    this.$refs.tabEmployeeElement.classList.add( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');
                    this.tabService = true;
                    this.tabRepeat = false;
                    this.tabCustomer = false;
                    this.tabEmployee = false;

                    break;
                case 'tabRepeat':
                    console.log('repeat');
                    this.$refs.tabServiceElement.classList.remove('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');
                    this.$refs.tabServiceElement.classList.add( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');

                    this.$refs.tabRepeatElement.classList.remove( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');
                    this.$refs.tabRepeatElement.classList.add('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');


                    this.$refs.tabCustomerElement.classList.remove('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');
                    this.$refs.tabCustomerElement.classList.add( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');

                    this.$refs.tabEmployeeElement.classList.remove('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');
                    this.$refs.tabEmployeeElement.classList.add( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');

                    this.tabService = false;
                    this.tabRepeat = true;
                    this.tabCustomer = false;
                    this.tabEmployee = false;

                    break;
                case 'tabCustomer':
                    console.log('Customer');
                    this.$refs.tabServiceElement.classList.remove('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');
                    this.$refs.tabServiceElement.classList.add( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');

                    this.$refs.tabRepeatElement.classList.remove('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');
                    this.$refs.tabRepeatElement.classList.add( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');

                    this.$refs.tabCustomerElement.classList.remove( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');
                    this.$refs.tabCustomerElement.classList.add('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');


                    this.$refs.tabEmployeeElement.classList.remove('active','border-blue-600','dark:text-blue-500','dark:border-blue-500');
                    this.$refs.tabEmployeeElement.classList.add( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');

                    this.tabService = false;
                    this.tabRepeat = false;
                    this.tabCustomer = true;
                    this.tabEmployee = false;

                    break;
                case 'tabEmployee':
                    console.log('Employee');
                    this.$refs.tabServiceElement.classList.remove('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');
                    this.$refs.tabServiceElement.classList.add( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');

                    this.$refs.tabRepeatElement.classList.remove('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');
                    this.$refs.tabRepeatElement.classList.add( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');

                    this.$refs.tabCustomerElement.classList.remove('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');
                    this.$refs.tabCustomerElement.classList.add( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');

                    this.$refs.tabEmployeeElement.classList.remove( 'border-transparent','hover:text-gray-600','hover:border-gray-300','dark:hover:text-gray-300');
                    this.$refs.tabEmployeeElement.classList.add('active','text-blue-600','border-blue-600','dark:text-blue-500','dark:border-blue-500');

                    this.tabService = false;
                    this.tabRepeat = false;
                    this.tabCustomer = false;
                    this.tabEmployee = true;

                    break;
            }
        },
    }))
    Alpine.store( 'registration', {
        init(){
           window.customEvents()
        }
    })





Livewire.start();
