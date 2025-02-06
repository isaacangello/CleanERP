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
        sidebarInit() {
            this.$refs.leftSideBar = document.getElementById('leftSideBar');
            this.$refs.leftSideBar.style.marginTop = this.$refs.navBar.offsetHeight + 'px';
            this.$refs.leftSideBar.style.overflowY = 'auto';
        }

    }));

    console.log(Livewire)

Livewire.start();