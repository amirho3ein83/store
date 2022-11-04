<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Card2 from "@/Components/Card2.vue";
import AmazingOffer from "@/Components/AmazingOffer.vue";
import Checkbox from "@/Components/Checkbox.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import "vue-horizontal-scroll/dist/vue-horizontal-scroll.css";

defineProps({
    products: Object,
});
</script>

<template>
    <Head title="Store Page" />

    <AppLayout>

<!-- component -->
<div class='max-w-md mx-auto mt-7'>
    <div class="relative flex items-center w-full h-12 rounded-lg focus-within:shadow-lg bg-white overflow-hidden">

        <input
        class="peer h-full w-full outline-none text-sm text-gray-700 pr-2"
        type="text"
        id="search"
        placeholder="Search something.." /> 
    </div>
</div>














  <!-- tabs -->
  <div
    class="mx-auto my-2 grid w-1/2 grid-cols-4 space-x-2 rounded-xl bg-gray-200 p-1"
    x-data="app"
  >
    <div>
      <input type="radio" name="option" id="1" class="peer hidden" checked />
      <label
        for="1"
        class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
        >most expensive</label
      >
    </div>

    <div>
      <input type="radio" name="option" id="2" class="peer hidden" />
      <label
        for="2"
        class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
        >cheapest</label
      >
    </div>

    <div>
      <input type="radio" name="option" id="3" class="peer hidden" />
      <label
        for="3"
        class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
        >purchase offers</label
      >
    </div>

    <div>
      <input type="radio" name="option" id="4" class="peer hidden" />
      <label
        for="4"
        class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
        >bestselling</label
      >
    </div>
  </div>
        <div class="grid grid-cols-5 gap-3 px-12 py-20 w-full">
            <Card2
                v-for="product of products.data"
                :key="product.id"
                :product="product"
            />
        </div>
    </AppLayout>
</template>
