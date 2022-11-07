import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";

export const useProductStore = defineStore("products", {
    state: () => ({ sub_total: 0, count_cart: 0, products: [] }),

    actions: {
        unlikeProduct(id) {
            axios.patch(route("unlike-product", { id: id }));
        },
        likeProduct(id) {
            axios.patch(route("like-product", { id: id }));
        },
        showProduct(id) {
            Inertia.get("/products/" +id);
        },
    },
});
