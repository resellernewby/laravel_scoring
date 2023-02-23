import './bootstrap';
import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import flatpickr from "flatpickr";
import Choices from 'choices.js';
import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import Tooltip from "@ryangjchandler/alpine-tooltip";

FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginFileValidateSize);
FilePond.registerPlugin(FilePondPluginFileValidateType);

window.flatpickr = flatpickr;
window.Choices = Choices;
window.FilePond = FilePond;
Alpine.plugin(mask);
Alpine.plugin(Tooltip);
window.Alpine = Alpine;
Alpine.start();
