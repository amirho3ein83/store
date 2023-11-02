import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";

export const managePageStore = defineStore("manage-pages", {
    state: () => ({ currentPage: "" ,crumbs:{
        'Home':route('home')
    }}),

    actions: {
        setPage(page) {
            this.currentSidebar = page;
            Inertia.get(
                route(page),
                {},
                {
                    preserveState: true,
                    onSuccess: () => {},
                }
            );
        }
    },
});
