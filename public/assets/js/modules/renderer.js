// renderer.js
import { ToastRenderer } from './components/toast.js';
import { FormHandler } from './components/form.js';
import { TableManager } from './components/table.js';

window.App = {
    Toast: new ToastRenderer(),
    Form: FormHandler,
    TableManager: TableManager, // Updated to allow dynamic instantiation
};

document.addEventListener("DOMContentLoaded", () => {
    if (typeof window.SimpleBar === "undefined") {
        console.error("SimpleBar library is not loaded.");
    } else {
        document.querySelectorAll("[data-simplebar]").forEach(el => {
            new window.SimpleBar(el);
        });
    }
});
