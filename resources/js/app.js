import './bootstrap';
import { createApp } from 'vue';

// Importa i componenti di base Shadcn
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';

// Monta Vue su ogni "isola" (elementi con classe .vue-island)
document.querySelectorAll('.vue-island').forEach(el => {
    createApp({})
        .component('UiButton', Button)
        .component('UiInput', Input)
        .mount(el);
});
