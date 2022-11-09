import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";

export const useProductStore = defineStore("products", {
    state: () => ({  products: [] }),

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
