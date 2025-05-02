// renderer.js
import { ToastRenderer } from './components/toast.js';
import { FormHandler } from './components/form.js';
import { TableManager } from './components/table.js';
import LetterAvatar from './components/letter-avatar.js';

window.App = {
    Toast: new ToastRenderer(),
    Form: FormHandler,
    TableManager: TableManager,
    LetterAvatar: LetterAvatar,
};
