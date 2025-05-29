import "./bootstrap";
import "../css/app.css"; // Impor file CSS Tailwind
import { createApp, h } from "vue";
import { createInertiaApp, router } from "@inertiajs/vue3";
import { initFlowbite } from "flowbite";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", {
            eager: true,
        });

        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
}).then(() => {
    // Inisialisasi Flowbite saat aplikasi dimuat pertama kali
    initFlowbite();
});

router.on("success", () => {
    initFlowbite();
});
