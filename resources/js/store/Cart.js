import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";

export const useCartStore = defineStore("cart", {
    state: () => ({ sub_total: 0 ,count_cart: 0 ,products:[]}),

    actions: {
        addToCart(id) {
            axios
                .post(route("addToCart"), {
                    product_id: id,
                })
                .then((res) => {
                  this.countCartItems(id)
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        countCartItems(id) {
            axios
                .get(route("cart.count"))
                .then((res) => {
                    this.count_cart = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getCartItems(id) {
            axios
                .get(route("cart.get.items"))
                .then((res) => {
                    this.products = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

         increaseItem  (id) {
            axios.patch(route("cart.increase-item", { id: id }));
        },
        
         decreaseItem  (id) {
            axios.patch(route("cart.decrease-item", { id: id }));
        },
        
         deleteItem  (id) {
            axios.delete(route("cart.delete-item", { id: id }));
        }
    },
});
