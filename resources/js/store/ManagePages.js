import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";

export const managePageStore = defineStore("manage-pages", {
    state: () => ({ currentPage: "" }),

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
        },
        chooseCategory(id) {
            Inertia.get(
                route('product-list',{id:id}),
                {},
                {
                    onSuccess: () => {},
                }
            );
        },
    },
});
