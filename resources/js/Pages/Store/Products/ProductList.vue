<script setup>
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import {
    ChevronDownIcon,
    FunnelIcon,
    MinusIcon,
    PlusIcon,
    Squares2X2Icon,
} from "@heroicons/vue/20/solid";

import {
    computed,
    onMounted,
    onUnmounted,
    reactive,
    ref,
    toRef,
    watch,
} from "vue";
import { useStorage } from "@/store/useStorage";
import { Inertia } from "@inertiajs/inertia";
import ProductCard5 from "@/Components/ProductCard5.vue";
import Pagination from "@/Components/Pagination.vue";
import debounce from "lodash/debounce";

let props = defineProps({
    products: Object,
    category: Object,
});

let search = useStorage("search");
let order_by = useStorage("order_by");
let filtered_color_ids = useStorage("filtered_color_ids");

let Fattr = ref([]);
let filtered_attributes = useStorage("filtered_attributes", Fattr.value);
// const object = { foo: ref(1) }
// const sets = ref([
//   [1, 2, 3, 4, 5],
//   [6, 7, 8, 9, 10]
// ])

// function even(numbers) {
//   return numbers.filter((number) => number % 2 === 0)
// }
// template
// <ul v-for="numbers in sets">
//   <li v-for="n in even(numbers)">{{ n }}</li>
// </ul>
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

const sortOptions = [
    { name: "جدیدترین", value: "newest" },
    { name: "پربازدیدترین", value: "most_visited" },
    { name: "محبوب ترین", value: "rate" },
    { name: "ارزان ترین", value: "cheapest" },
    { name: "گران ترین", value: "most_expensive" },
    { name: "پرفروش ترین", value: "bestselling" },
];

const filterLabels = computed(() => {
    props.category.attributes.forEach((attr) => {
        // filtered_attributes.value.push({ [`${attr.slug}`]: [] });
        // filtered_attributes.value[[`${attr.slug}`]] = 's';filtered_attributes:Array
        // const index = arr.findIndex((object) => {
        //     return object.id === "b";
        // });
    });
    return props.category.attributes;
});

const flushFilters = () => {
    localStorage.removeItem("search");
    localStorage.removeItem("order_by");
    // window.location.href.split("?")[0].split("#")[0];
};

const filters = reactive([]);

const fetchData = (section, option) => {
    filters.push({ [`${section}`]: option });

    // document.getElementById("filterForm").submit();
};

const mobileFiltersOpen = ref(false);

onUnmounted(() => {
    flushFilters();
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,
    components: { Comment },
};
</script>

<template>
    <div class="bg-white">
        <div>
            <!-- Mobile filter dialog -->
            <TransitionRoot as="template" :show="mobileFiltersOpen">
                <Dialog
                    as="div"
                    class="relative z-40 lg:hidden"
                    @close="mobileFiltersOpen = false"
                >
                    <TransitionChild
                        as="template"
                        enter="transition-opacity ease-linear duration-300"
                        enter-from="opacity-0"
                        enter-to="opacity-100"
                        leave="transition-opacity ease-linear duration-300"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                    >
                        <div class="fixed inset-0 bg-black bg-opacity-25" />
                    </TransitionChild>

                    <div class="fixed inset-0 z-40 flex">
                        <TransitionChild
                            as="template"
                            enter="transition ease-in-out duration-300 transform"
                            enter-from="translate-x-full"
                            enter-to="translate-x-0"
                            leave="transition ease-in-out duration-300 transform"
                            leave-from="translate-x-0"
                            leave-to="translate-x-full"
                        >
                            <DialogPanel
                                class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl"
                            >
                                <div
                                    class="flex items-center justify-between px-4"
                                >
                                    <button
                                        class="text-md m-2 p-2 font-medium text-red-700 hover:text-red-600"
                                        @click="flushFilters()"
                                    >
                                        حذف فیلتر ها
                                    </button>
                                    <button
                                        type="button"
                                        class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
                                        @click="mobileFiltersOpen = false"
                                    >
                                        <span class="sr-only">Close menu</span>
                                        <XMarkIcon
                                            class="h-6 w-6"
                                            aria-hidden="true"
                                        />
                                    </button>
                                </div>

                                <!-- mobile Filters -->
                                <form @submit.prevent class="mt-4 border-t border-gray-200">
                                    <Disclosure
                                        as="div"
                                        v-for="section in filterLabels"
                                        :key="section.id"
                                        class="border-t border-gray-200 px-4 py-6"
                                        v-slot="{ open }"
                                    >
                                        <h3 class="-mx-2 -my-3 flow-root">
                                            <DisclosureButton
                                                class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                                            >
                                                <span
                                                    class="ml-6 flex items-center"
                                                >
                                                    <PlusIcon
                                                        v-if="!open"
                                                        class="h-5 w-5"
                                                        aria-hidden="true"
                                                    />
                                                    <MinusIcon
                                                        v-else
                                                        class="h-5 w-5"
                                                        aria-hidden="true"
                                                    />
                                                </span>
                                                <span
                                                    class="font-medium text-slate-800"
                                                    >{{ section.name }}</span
                                                >
                                            </DisclosureButton>
                                        </h3>
                                        <DisclosurePanel class="pt-6">
                                            <!-- :checked="option.checked" -->

                                            <div class="space-y-4">
                                                <div
                                                    v-for="option of section.options"
                                                    :key="option.slug"
                                                    class="flex items-center"
                                                >
                                                    <input
                                                        :id="`filter-${section.id}-${option.id}`"
                                                        :name="`${section.slug}[]`"
                                                        :value="option.slug"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    />
                                                    <label
                                                        :for="`filter-${section.id}-${option.id}`"
                                                        class="ml-3 text text-gray-600"
                                                        >{{
                                                            option.name
                                                        }}</label
                                                    >
                                                </div>
                                            </div>
                                        </DisclosurePanel>
                                    </Disclosure>
                                </form>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </Dialog>
            </TransitionRoot>

            <main class="mx-auto w-full px-4 sm:px-6 lg:px-8">
                <div
                    class="flex items-baseline justify-between border-b border-gray-200 pt-10 pb-6"
                >
                    <div class="flex items-center gap-x-5">
                        <div class="relative text-gray-600">
                            <input
                                type="search"
                                name="serch"
                                v-model="search"
                                placeholder="جستجو"
                                class="bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none"
                            />
                            <button
                                type="submit"
                                class="absolute right-0 top-0 mt-2 mr-4"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                                    />
                                </svg>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <Menu
                                as="div"
                                class="relative inline-block text-left"
                            >
                                <div>
                                    <MenuButton
                                        class="group inline-flex justify-center text-md sm:text-lg py-1 font-medium text-gray-700 hover:text-slate-800"
                                    >
                                        <!-- <p
                                            v-if="order_by"
                                            v-text="order_by"
                                        ></p>
                                        <p v-else>ترتیب</p> -->
                                        ترتیب
                                        <ChevronDownIcon
                                            class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                            aria-hidden="true"
                                        />
                                    </MenuButton>
                                </div>

                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="absolute left-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    >
                                        <div class="py-1">
                                            <MenuItem
                                                v-for="option in sortOptions"
                                                :key="option.value"
                                            >
                                                <div>
                                                    <input
                                                        type="radio"
                                                        name="option"
                                                        v-model="order_by"
                                                        :id="option.value"
                                                        :value="option.value"
                                                        class="peer hidden"
                                                    />
                                                    <label
                                                        :for="option.value"
                                                        v-text="option.name"
                                                        class="block cursor-pointer hover:bg-gray-600/20 select-none p-2 text-center peer-checked:bg-gray-500 peer-checked:font-bold peer-checked:text-white"
                                                    >
                                                    </label>
                                                </div>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>
                            <button
                                type="button"
                                class="-m-2 ml-4 self-end px-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden"
                                @click="mobileFiltersOpen = true"
                            >
                                <!-- <FunnelIcon
                                    class="h-5 w-5"
                                    aria-hidden="true"
                                /> -->
                                <button
                                    class="h-8 w-8 text-slate-800"
                                    aria-hidden="true"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        strokeWidth="{1.5}"
                                        stroke="currentColor"
                                        className="w-6 h-6"
                                    >
                                        <path
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"
                                        />
                                    </svg>
                                </button>
                            </button>
                        </div>
                    </div>

                    <h1
                        class="text-xl hidden sm:block font-bold tracking-tight text-slate-800"
                    >
                        <span
                            class="block text-yellow-900"
                            v-text="category.name"
                        ></span>
                    </h1>
                </div>

                <section aria-labelledby="products-heading" class="pt-6 pb-24">
                    <h2 id="products-heading" class="sr-only">Products</h2>

                    <div class="flex w-full xl:gap-10">
                        <!-- Product grid -->
                        <div class="lg:col-span-3 lg:w-5/6 p-4">
                            <div class="flex flex-wrap -m-4 pb-20">
                                <ProductCard5
                                    v-for="product of products.data"
                                    :key="product.id"
                                    :product="product"
                                />
                            </div>
                            <!-- pagination -->
                            <div
                                class="py-4 mt-4 border-t-2"
                                v-show="
                                    products.data != undefined &&
                                    products.data != {}
                                "
                            >
                                <Pagination
                                    :nextPage="products.next_page_url"
                                    :previousPage="products.prev_page_url"
                                    :currentPage="products.current_page"
                                />
                            </div>
                        </div>

                        <!--   Filters -->
                        <!-- @submit.prevent="fetchData"  -->
                        <form @submit.prevent id="filterForm" class="hidden lg:block lg:w-1/6">
                            <div
                                class="flex justify-between items-center border-b-2"
                            >
                                <button
                                    class="text-md m-2 p-2 font-medium text-red-700 hover:text-red-600"
                                    @click="flushFilters()"
                                >
                                    حذف فیلتر ها
                                </button>
                                <h1
                                    class="text-xl hidden sm:block font-semibold tracking-tight"
                                >
                                    <span class="block text-slate-800"
                                        >فیلتر ها</span
                                    >
                                </h1>
                            </div>

                            <Disclosure
                                as="div"
                                v-for="section in filterLabels"
                                :key="`attr-${section.slug}`"
                                class="border-b border-gray-200 py-6 text-md"
                                v-slot="{ open }"
                            >
                                <h3 class="-my-3 flow-root">
                                    <DisclosureButton
                                        class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                    >
                                        <span class="ml-6 flex items-center">
                                            <PlusIcon
                                                v-if="!open"
                                                class="h-5 w-5"
                                                aria-hidden="true"
                                            />
                                            <MinusIcon
                                                v-else
                                                class="h-5 w-5"
                                                aria-hidden="true"
                                            />
                                        </span>
                                        <span
                                            class="font-medium text-slate-800 text-md sm:text-lg"
                                            >{{ section.name }}</span
                                        >
                                    </DisclosureButton>
                                </h3>
                                <DisclosurePanel class="pt-6">
                                    <!-- :checked="option.checked" -->
                                    <!-- @change='onChange($event.target.checked)' -->
                                    <div class="space-y-4">
                                        <div
                                            v-for="option of section.options"
                                            :key="option.slug"
                                            class="flex items-center"
                                        >
                                            <input
                                                :id="`filter-${section.slug}-${option.slug}`"
                                                :name="`${section.slug}[]`"
                                                :value="option.slug"
                                                type="checkbox"
                                                @change="
                                                    fetchData(
                                                        $event.target.name,
                                                        $event.target.value
                                                    )
                                                "
                                                class="h-4 w-4 filterCheckbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                            />
                                            <label
                                                :for="`filter-${section.slug}-${option.slug}`"
                                                class="ml-3 text text-gray-600"
                                                >{{ option.name }}</label
                                            >
                                        </div>
                                    </div>
                                </DisclosurePanel>
                            </Disclosure>
                        </form>
                    </div>
                </section>
            </main>
        </div>
    </div>
</template>
