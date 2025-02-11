//'resources/css/app.css','resources/fa6/css/all.css','resources/fa6/js/all.js'

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import  Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import '../css/app.css';
// import '../css/cleopatra.css'
import '../fa6/pro/css/all.css';
import '../fa6/pro/js/all.js';
import 'animate.css';
import {toastAlert,Toast_5000,swalConfirmCallback,swalConfirm} from "./custom/helpers/plugins_init.js";


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

        pageInit(){

                document.getElementById('gifLoading').style.display = 'none';
                // document.getElementById('contentHidden').style.display = 'block';
            console.log();
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

    // console.log(Livewire)

Livewire.start();
