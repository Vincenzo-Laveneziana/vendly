import './bootstrap';
import { createApp } from 'vue';

import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

// Importa i componenti di base Shadcn
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Slider } from '@/components/ui/slider';
import {
    Collapsible,
    CollapsibleContent,
    CollapsibleTrigger,
} from '@/components/ui/collapsible'
import {
    Pagination,
    PaginationContent,
    PaginationEllipsis,
    PaginationFirst,
    PaginationItem,
    PaginationLast,
    PaginationNext,
    PaginationPrevious,
} from '@/components/ui/pagination'

// Funzione per registrare tutti i componenti su un'app Vue
window.registerVendlyComponents = (app) => {
    app.component('UiButton', Button)
        .component('UiInput', Input)
        .component('UiSlider', Slider)
        .component('UiPagination', Pagination)
        .component('UiPaginationContent', PaginationContent)
        .component('UiPaginationEllipsis', PaginationEllipsis)
        .component('UiPaginationFirst', PaginationFirst)
        .component('UiPaginationItem', PaginationItem)
        .component('UiPaginationLast', PaginationLast)
        .component('UiPaginationNext', PaginationNext)
        .component('UiPaginationPrevious', PaginationPrevious)
        .component('Collapsible', Collapsible)
        .component('CollapsibleContent', CollapsibleContent)
        .component('CollapsibleTrigger', CollapsibleTrigger);
};

window.createVendlyApp = (options = {}) => {
    const app = createApp(options);
    window.registerVendlyComponents(app);
    return app;
};

// Monta Vue su ogni "isola" (elementi con classe .vue-island)
document.querySelectorAll('.vue-island').forEach(el => {
    const app = window.createVendlyApp({});
    el.__vue_app__ = app.mount(el);
});

