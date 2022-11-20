import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";

export const useProductStore = defineStore("products", {
    state: () => ({ products: [], comments: [] }),

    actions: {
        unlikeProduct(id) {
            axios.patch(route("unlike-product", { id: id }));
        },
        likeProduct(id) {
            axios.patch(route("like-product", { id: id }));
        },
        showProduct(slug) {
            Inertia.get("/products/" + slug);
        },
        fetchComments(id) {
            axios
                .get(route("product.comment", {
                    id: id,
                }), [])
                .then((res) => {
                    this.comments = res.data
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
});
