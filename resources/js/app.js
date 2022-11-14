import "./bootstrap";
import "../css/app.css";

import { createApp, h, ref } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import VueChartkick from "vue-chartkick";
import "chartkick/chart.js";
import ScrollParallax from "vue3-parallax/src/components/ScrollParallax.vue";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, app, props, plugin }) {
        const MyApp = createApp({ render: () => h(app, props) });
        MyApp.provide("online_users", ref([]));

        return MyApp.use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(VueChartkick)
            .component("scroll-parallax", ScrollParallax)
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4B5563" });
