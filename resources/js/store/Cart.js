import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";
import { createToast } from "mosha-vue-toastify";


export const useCartStore = defineStore("cart", {
    state: () => ({
        subtotal: 0,
        finalAmount: 0,
        count_cart: 0,
        form_step: 1,
        products: [],
        user_address: "",
    }),

    actions: {
        addToCart(id, picked_color) {
            axios
                .post(route("addToCart"), {
                    product_id: id,
                    picked_color_id: picked_color,
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

        increaseOrderItem(id, amount) {
            this.subtotal += amount;
            axios.patch(route("cart.increase-order", { id: id }));
        },

        decreaseOrderItem(id, amount) {
            this.subtotal -= amount;

            axios.patch(route("cart.decrease-order", { id: id }));
        },

        deleteOrderItem(id, amount, qty) {

             axios.delete(route("orderItem.delete", { id: id }));
            this.subtotal -= (amount * qty);

        },
        decutFromWallet(walletBalance) {
            this.subtotal -= walletBalance;
        },
        dontDecutFromWallet(walletBalance) {
            this.subtotal += walletBalance;
        },
    },
});
