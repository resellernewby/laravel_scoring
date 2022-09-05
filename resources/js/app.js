import './bootstrap';
import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import flatpickr from "flatpickr";
import Choices from 'choices.js';

Alpine.plugin(mask);

window.flatpickr = flatpickr;
window.Choices = Choices;
window.Alpine = Alpine;
Alpine.start();
