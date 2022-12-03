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
        deleteProduct(id) {
            axios.delete(route("product.delete", { product: id }));
        },
        showProduct(slug) {
            Inertia.get("/products/" + slug);
        },
        showProductEditPage(id) {
            Inertia.get(route("admin.product.edit", { id: id }));
        },
        fetchComments(id) {
            axios
                .get(
                    route("product.comments", {
                        id: id,
                    }),
                    []
                )
                .then((res) => {
                    this.comments = res.data;
                })
                .catch((error) => {
                    if (error.response.status == 500) {
                        createToast("خطای سرور ", {
                            position: "top-center",
                            toastBackgroundColor: "#fc4242",
                            timeout: 2100,
                            transition: "slide",
                        });
                    }
                    console.log(error);
                });
        },
    },
});
