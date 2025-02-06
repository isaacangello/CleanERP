//'resources/css/app.css','resources/fa6/css/all.css','resources/fa6/js/all.js'

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import '../css/app.css';
import '../fa6/pro/css/all.css';
import '../fa6/pro/js/all.js';

    Alpine.data('cnf', () => ({
        show: false,
        profileDropDown: false,
        notifications: false,
        messages: false,

        toggle() {
            this.show = !this.show;
        },
        sidebarInit(el1) {
                const navBar = document.getElementById('navBar');
                const leftSideBar = document.getElementById('leftSideBar');
                console.log("adjust margin top",navBar.offsetHeight);
                leftSideBar.style.marginTop = navBar.offsetHeight + 'px';
        },

        pageInit(){

                document.getElementById('gifLoading').style.display = 'none';
                // document.getElementById('contentHidden').style.display = 'block';
            console.log();
        }

    }));
    // console.log(Livewire)

Livewire.start();
