<script setup>
import { onMounted, ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useCartStore } from "@/store/Cart.js";
import Footer from "../Pages/Footer.vue";
import Navbar from "@/Components/Navbar.vue";
import { managePageStore } from "@/store/ManagePages";
import { Head } from "@inertiajs/inertia-vue3";

const storePages = managePageStore();
const storeCart = useCartStore();

const logout = () => {
    Inertia.post(route("logout"));
};

let props = defineProps({
    errors: Object
})

watch(props.errors, (val) => {
    alert(val)
})

</script>

<template>
    <div class="  work-sans leading-normal text-base tracking-normal">
        <Navbar :dark="true" :snipperColor="`#445da2`"/>

        <slot />

        <Footer />
    </div>
</template>

<style>
i {
    font-size: 24px;
}

/* width */
::-webkit-scrollbar {
    width: 3px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
