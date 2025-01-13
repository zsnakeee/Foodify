import './bootstrap';
import '../../vendor/masmerise/livewire-toaster/resources/js'; // 👈
import $ from 'jquery';
import * as bootstrap from 'bootstrap';
import 'animate.css';
import 'lazysizes';
import '@fortawesome/fontawesome-free/js/all.min.js';
import '@fortawesome/fontawesome-free/css/all.min.css';

import './carousel.js';
import './main.js';
import './alpinejs/component.js';

window.bootstrap = bootstrap;
window.printInvoice = function () {
    document.querySelector(".top").style.display = "none";
    document.querySelector(".invoice-section").style.padding = "40px";
    document.querySelector(".header").style.padding = "40px 40px";
    window.print();
    window.onafterprint = function () {
        window.location.reload()
    }
}

