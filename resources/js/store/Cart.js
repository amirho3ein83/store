import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";
import { createToast } from "mosha-vue-toastify";


export const useCartStore = defineStore("cart", {
    state: () => ({
        subtotal: 0,
        count_cart: 0,
        form_step: 1,
        products: [],
        user_address: "",
    }),

    actions: {
        addToCart(id, picked_color, picked_size) {
            axios
                .post(route("addToCart"), {
                    product_id: id,
                    picked_color: picked_color,
                    picked_size: picked_size,
                })
                .then((res) => {
                    this.countOrders(id);
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
                });
        },
        countOrders(id) {
            axios
                .get(route("cart.count"))
                .then((res) => {
                    this.count_cart = res.data;
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
                });
        },
        getOrders(id) {
            axios
                .get(route("cart.get.items"))
                .then((res) => {
                    this.products = res.data;
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
                });
        },
        getUserAddress() {
            axios
                .get(route("user.address"))
                .then((res) => {
                    this.user_address = res.data;
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
                });
        },

        increaseOrder(id, amount) {
            this.subtotal += amount;
            axios.patch(route("cart.increase-order", { id: id }));
        },

        decreaseOrder(id, amount) {
            this.subtotal -= amount;

            axios.patch(route("cart.decrease-order", { id: id }));
        },

        deleteOrder(id, amount, qty) {
            this.subtotal -= amount * qty;

            axios.delete(route("cart.delete-order", { id: id }));
        },
    },
});
