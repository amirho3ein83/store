import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";

export const useCartStore = defineStore("cart", {
    state: () => ({ subtotal: 0, count_cart: 0, products: [] ,user_address:''}),

    actions: {
        addToCart(id) {
            axios
                .post(route("addToCart"), {
                    product_id: id,
                })
                .then((res) => {
                    this.countOrders(id)
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        countOrders(id) {
            axios
                .get(route("cart.count"))
                .then((res) => {
                    this.count_cart = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getOrders(id) {
            axios
                .get(route("cart.get.items"))
                .then((res) => {
                    this.products = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getUserAddress() {
            axios
                .get(route("user.address"))
                .then((res) => {
                    this.user_address = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        increaseOrder(id) {
            axios.patch(route("cart.increase-order", { id: id }));
        },

        decreaseOrder(id) {
            axios.patch(route("cart.decrease-order", { id: id }));
        },

        deleteOrder(id) {
            axios.delete(route("cart.delete-order", { id: id }));
        },
        addToSubtotal(num) {
            this.subtotal = this.subtotal + num
        }
    },
});
