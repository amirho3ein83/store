<script setup>
import { onMounted, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useCartStore } from "@/store/Cart.js";

const storeCart = useCartStore();

const logout = () => {
    Inertia.post(route("logout"));
};


onMounted(() => {
    storeCart.countCartItems()
});
</script>

<template>
    <body
        class="bg-gray-900 text-gray-600 work-sans leading-normal text-base tracking-normal"
    >
        <!--Nav-->
        <nav id="header" class="w-full z-30 top-0 py-1">
            <div
                class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3"
            >
                <a href="/" class="text-2xl text-gray-200 cursor-pointer">Space Store</a>

                <div
                    class="order-2 md:order-3 flex items-center"
                    id="nav-content"
                >
                    <a
                        class="inline-block no-underline hover:text-black"
                        href="#"
                    >
                        <svg
                            class="fill-current hover:text-black text-gray-200"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                        >
                            <circle fill="none" cx="12" cy="7" r="3" />
                            <path
                                d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z"
                            />
                        </svg>
                    </a>

                    <a
                        class="pl-3 relative no-underline text-gray-200 hover:text-black"
                        href="/cart"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="28"
                            height="28"
                            fill="currentColor"
                            class="bi bi-cart3"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
                            />
                        </svg>
                        <span v-if="storeCart.count_cart != 0"
                            class="absolute -right-1 top-0 rounded-full bg-red-600 w-5 h-5 top right p-0 m-0 text-white font-mono text-sm leading-tight text-center"
                            >{{storeCart.count_cart}}
                        </span>
                    </a>
                </div>
            </div>
        </nav>

        <slot />
    </body>
</template>
