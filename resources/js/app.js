// require("./bootstrap");
import "@fortawesome/fontawesome-free/css/all.css";
import "@fortawesome/fontawesome-free/js/all.js";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { Ziggy } from "../../vendor/tightenco/ziggy";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

InertiaProgress.init({ color: "#0086ff" });

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mixin({
                methods: {
                    rupiah(data) {
                        return new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR",
                            minimumFractionDigits: 0,
                        }).format(data);
                    },
                },
            })
            .mount(el);
    },
});
