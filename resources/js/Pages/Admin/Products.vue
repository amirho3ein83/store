<script setup>
import Table from "@/Components/Table.vue";
import { onBeforeUnmount, onUnmounted, watch } from "vue";
import { useStorage } from "@/store/useStorage";
import { Inertia } from "@inertiajs/inertia";
import Dropdown from "@/Components/Dropdown.vue";
import Pagination from "@/Components/Pagination.vue";
import ProductRow from "@/Components/ProductRow.vue";
import debounce from "lodash/debounce";

let props = defineProps({
    products: Object,
    categories: Object,
});

let search = useStorage("search");
let order_by = useStorage("order_by");
let filter_category = useStorage("filter_category");

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

watch(
    filter_category,
    debounce(function (value) {
        Inertia.get(
            window.location.href,
            { category: value },
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

const flushFilters = () => {
    search.value = null;
    order_by.value = null;
    filter_category.value = null;
    // window.location.href.split("?")[0].split("#")[0];
    window.location = window.location.href.split("?")[0];

};
onBeforeUnmount(() => {
    sessionStorage.removeItem("search");
    sessionStorage.removeItem("order_by");
    sessionStorage.removeItem("filter_category");
});
</script>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    layout: AdminLayout,
};
</script>
<template>
    <div
        class="flex flex-col items-center justify-start min-h-screen bg-gray-100"
    >
        <Link
            :href="route('admin.product.create')"
            class="self-end z-10 px-7 py-2"
        >
            <button
                class="items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md"
            >
                اضافه کردن محصول
            </button>
        </Link>
        <div
            class="flex items-center justify-between my-3 space-x-6 shadow-md w-2/3"
        >
            <div class="relative text-gray-300 focus-within:text-gray-400">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <button
                        type="submit"
                        class="p-1 focus:outline-none focus:shadow-outline"
                    >
                        <svg
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            class="w-6 h-6"
                        >
                            <path
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            ></path>
                        </svg>
                    </button>
                </span>
                <input
                    type="search"
                    v-model="search"
                    class="py-2 text-sm text-white bg-gray-700 placeholder:text-slate-100 rounded-md pl-10 focus:outline-none focus:bg-gray-500 focus:text-gray-900"
                    placeholder="Search..."

                />
            </div>
            <div
                class="flex py-3 px-4 rounded-lg text-gray-500 font-semibold cursor-pointer"
            >
                <Dropdown align="right" width="48">
                    <template #trigger>
                        <span v-if="filter_category" v-text="filter_category">
                        </span>
                        <span v-else> دسته بندی</span>
                        <i class="bi bi-chevron-down px-2"></i>
                    </template>

                    <template #content>
                        <div>
                            <button
                                @click="filter_category = null"
                                class="block cursor-pointer text-gray-50 hover:bg-gray-600 w-full rounded-xl p-2"
                            >
                                همه
                            </button>
                        </div>
                        <div
                            v-for="category of categories"
                            :key="category.slug"
                        >
                            <input
                                type="radio"
                                v-model="filter_category"
                                name="option"
                                :id="category.slug"
                                :value="category.slug"
                                class="peer hidden"
                            />
                            <label
                                :for="category.slug"
                                class="block cursor-pointer text-gray-50 hover:bg-gray-600 select-none rounded-xl p-2 text-center peer-checked:bg-gray-500 peer-checked:font-bold peer-checked:text-white"
                                >{{ category.name }}</label
                            >
                        </div>
                    </template>
                </Dropdown>
            </div>
            <div
                class="flex py-3 px-4 rounded-lg text-gray-100 font-semibold cursor-pointer"
            >
                <Dropdown align="right" width="48">
                    <template #trigger>
                        <i class="bi bi-border-width text-gray-700"></i>
                    </template>

                    <template #content>
                        <div>
                            <input
                                type="radio"
                                v-model="order_by"
                                name="option"
                                id="143"
                                value="rate"
                                class="peer hidden"
                            />
                            <label
                                for="143"
                                class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
                                >امتیاز</label
                            >
                        </div>
                        <div>
                            <input
                                type="radio"
                                v-model="order_by"
                                name="option"
                                id="144"
                                value="most_visited"
                                class="peer hidden"
                            />
                            <label
                                for="144"
                                class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
                                >بیشترین بازدید</label
                            >
                        </div>

                        <div>
                            <input
                                type="radio"
                                v-model="order_by"
                                name="option"
                                id="145"
                                value="newest"
                                class="peer hidden"
                            />
                            <label
                                for="145"
                                class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
                                >جدیدترین</label
                            >
                        </div>

                        <div>
                            <input
                                type="radio"
                                v-model="order_by"
                                name="option"
                                id="146"
                                value="bestselling"
                                class="peer hidden"
                            />
                            <label
                                for="146"
                                class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white"
                                >پرفروش ترین</label
                            >
                        </div>
                    </template>
                </Dropdown>
            </div>
            <button
                class="text-md m-2 p-2 font-medium text-red-700 hover:text-red-600"
                @click="flushFilters()"
            >
                حذف فیلتر ها
            </button>
        </div>

        <table class="text-gray-400 w-5/6 text-sm">
            <thead class="bg-gray-800 my-1 text-gray-300">
                <tr>
                    <th class="p-3 text-left">عنوان</th>
                    <th class="p-3">تعداد فروش</th>
                    <th class="p-3">دسته بندی</th>
                    <th class="p-3">(تومان) قیمت</th>
                    <th class="p-3">موجودی</th>
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                <ProductRow
                    v-for="product of products.data"
                    :key="product.id"
                    :product="product"
                />
            </tbody>
        </table>
    </div>
    <!-- pagination -->
    <div v-show="products.data != undefined && products.data != {}">
        <Pagination
            :nextPage="products.next_page_url"
            :previousPage="products.prev_page_url"
            :currentPage="products.current_page"
        />
    </div>
</template>
<style scoped>
.table {
    border-spacing: 0 15px;
}

i {
    font-size: 20px;
}

.table tr {
    border-radius: 20px;
}

tr td:nth-child(n + 5),
tr th:nth-child(n + 5) {
    border-radius: 0 0.625rem 0.625rem 0;
}

tr td:nth-child(1),
tr th:nth-child(1) {
    border-radius: 0.625rem 0 0 0.625rem;
}
</style>
