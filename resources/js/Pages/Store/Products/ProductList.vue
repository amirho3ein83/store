<script setup>
import axios from "axios";
import { computed, onMounted, ref, watch } from "vue";
import { managePageStore } from "@/store/ManagePages";
import { useStorage } from "@/store/useStorage";
import { Inertia } from "@inertiajs/inertia";
import Card2 from "@/Components/Card2.vue";
import ProductCard3 from "@/Components/ProductCard3.vue";
import Pagination from "@/Components/Pagination.vue";
import debounce from "lodash/debounce";

const storePages = managePageStore();

let props = defineProps({
    products: Object,
    filters: Object,
});

let search = useStorage("search");
let order_by = useStorage("order_by");

watch(
    search,
    debounce(function (value) {
        Inertia.get(
            window.location.href,
            { search: value },
            {
                replace: true,
                preserveState: true,
                preserveScroll: true,
                onSuccess: (res) => {
                    if (res.data) {
                        props.products.value = res.data;
                    }
                },
            }
        );
    }, 300)
);

watch(
    order_by,
    debounce(function (value) {
        Inertia.get(
            window.location.href,
            { order_by: value, search: search.value },
            {
                replace: true,
                preserveState: true,
                preserveScroll: true,
                onSuccess: (res) => {
                    if (res.data) {
                        props.products.value = res.data;
                    }
                },
            }
        );
    }, 300)
);
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default{
    layout: AppLayout,
    components: { Comment }
}
</script>
<template>
        <!-- search bar -->
        <div class="max-w-md mx-auto px-2 mt-7">
            <div
                class="relative flex items-center w-full h-12 rounded-lg focus-within:shadow-lg bg-white overflow-hidden"
            >
                <input
                    class="peer h-full w-full outline-none text-sm text-gray-700 pr-2"
                    type="text"
                    v-model="search"
                    placeholder="Search something.."
                />
            </div>
        </div>
        <!-- tabs -->
        <div
            class="mx-auto px-2 max-w-xl my-2 flex flex-wrap gap-1 justify-between align-baseline rounded-xl bg-gray-200 p-1"
            x-data="app"
        >
            <div>
                <input
                    type="radio"
                    name="option"
                    v-model="order_by"
                    id="1"
                    value="most_expensive"
                    class="peer hidden"
                />
                <label
                    for="1"
                    class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
                    >most expensive</label
                >
            </div>

            <div>
                <input
                    type="radio"
                    v-model="order_by"
                    name="option"
                    id="2"
                    value="cheapest"
                    class="peer hidden"
                />
                <label
                    for="2"
                    class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
                    >cheapest</label
                >
            </div>

            <div>
                <input
                    type="radio"
                    v-model="order_by"
                    name="option"
                    id="3"
                    value="rate"
                    class="peer hidden"
                />
                <label
                    for="3"
                    class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
                    >rate</label
                >
            </div>
            <div>
                <input
                    type="radio"
                    v-model="order_by"
                    name="option"
                    id="4"
                    value="most_visited"
                    class="peer hidden"
                />
                <label
                    for="4"
                    class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
                    >most visited</label
                >
            </div>

            <div>
                <input
                    type="radio"
                    v-model="order_by"
                    name="option"
                    id="5"
                    value="newest"
                    class="peer hidden"
                />
                <label
                    for="5"
                    class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
                    >newest</label
                >
            </div>

            <div>
                <input
                    type="radio"
                    v-model="order_by"
                    name="option"
                    id="6"
                    value="bestselling"
                    class="peer hidden"
                />
                <label
                    for="6"
                    class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
                    >bestselling</label
                >
            </div>
        </div>

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap -m-4 ">
        <ProductCard3
        v-for="product of products.data"
            :key="product.id"
            :product="product"            />

    </div>
  </div>
</section>


        <!-- pagination -->
        <div v-show="products.data != undefined && products.data != {}">
            <Pagination
                :nextPage="products.next_page_url"
                :previousPage="products.prev_page_url"
                :currentPage="products.current_page"
            />
        </div>
</template>
