<script setup>
import axios from "axios";
import { computed, onMounted, ref, watch } from "vue";
import { managePageStore } from "@/store/ManagePages";
import { useStorage } from "@/store/useStorage";
import { Inertia } from "@inertiajs/inertia";
import Card2 from "@/Components/Card2.vue";
import Pagination from "@/Components/Pagination.vue";
import debounce from "lodash/debounce";
import AppLayout from "@/Layouts/AppLayout.vue";

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

<template>
    <AppLayout>
        <!-- component -->
        <div class="max-w-md mx-auto mt-7">
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
            class="mx-auto my-2 grid w-1/2 grid-cols-4 space-x-2 rounded-xl bg-gray-200 p-1"
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
                    value="newest"
                    class="peer hidden"
                />
                <label
                    for="3"
                    class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
                    >newest</label
                >
            </div>

            <div>
                <input
                    type="radio"
                    v-model="order_by"
                    name="option"
                    id="4"
                    value="bestselling"
                    class="peer hidden"
                />
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
        <div v-show="products.data != undefined && products.data != {}">
            <Pagination
                :nextPage="products.next_page_url"
                :previousPage="products.prev_page_url"
                :currentPage="products.current_page"
            />
        </div>
    </AppLayout>
</template>
