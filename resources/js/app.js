import './bootstrap';
import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import flatpickr from "flatpickr";

Alpine.plugin(mask);

window.flatpickr = flatpickr;
window.Alpine = Alpine;
Alpine.start();
