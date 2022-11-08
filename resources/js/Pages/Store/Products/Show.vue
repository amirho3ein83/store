<script setup>
import { Head, buttonnk } from "@inertiajs/inertia-vue3";
import AddToCartButton from "@/Components/AddToCartButton.vue";
import InCartButton from "@/Components/InCartButton.vue";
import SkeletonLoading from "@/Components/SkeletonLoading.vue";
import SizeRadio from "@/Components/SizeRadio.vue";
import RateButton from "@/Components/RateButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import { useProductStore } from "@/store/Product.js";

const storeProduct = useProductStore();

let props = defineProps({
    product: Object,
});

let picked_color = ref("");
let is_liked = ref(props.product.is_liked);

const chooseColor = (color) => {
    picked_color.value = color;
};

let picked_size = ref("");

const chooseSize = (size) => {
    picked_size.value = size;
};

const likeProduct = (id) => {
    is_liked.value = true;
    storeProduct.likeProduct(id);
};

const unlikeProduct = (id) => {
    is_liked.value = false;
    storeProduct.unlikeProduct(id);
};
</script>
<template>
    <AppLayout>
        <!-- component -->
        <div
            class="min-w-screen h-full animated fadeIn faster flex justify-center items-center inset-0 z-50 outbuttonne-none focus:outbuttonne-none bg-no-repeat bg-center bg-cover"
        >
            <div class="w-full h-screen relative">
                <SkeletonLoading v-if="!product.id" />
                <img
                    v-else
                    class="object-cover w-full h-full brightness-50"
                    src="./pics/13.webp "
                    alt=""
                />
                <div
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 min-h-screen flex flex-col items-center justify-center"
                >
                    <div class="container">
                        <div
                            class="max-w-md w-full bg-gray-800 shadow-lg my-3 rounded-xl p-6"
                        >
                            <div class="flex flex-col">
                                <div>
                                    <div class="relative h-62 w-full mb-3">
                                        <div
                                            class="absolute flex flex-col top-0 right-0 p-3"
                                        >
                                            <button
                                                v-if="is_liked"
                                                @click="
                                                    unlikeProduct(product.id)
                                                "
                                                class="transition ease-in duration-75 active:scale-100 hover:scale-105 bg-gray-800 hover:text-purple-500 shadow hover:shadow-md text-gray-500 rounded-full w-9 h-9 text-center p-1"
                                            >
                                                <i
                                                    class="bi bi-heart-fill text-red-600"
                                                ></i>
                                            </button>

                                            <button
                                                v-else
                                                @click="likeProduct(product.id)"
                                                class="transition ease-in duration-75 active:scale-100 hover:scale-105 bg-gray-800 hover:text-purple-500 shadow hover:shadow-md text-gray-500 rounded-full w-9 h-9 text-center p-1"
                                            >
                                                <i
                                                    class="bi bi-heart text-red-600"
                                                ></i>
                                            </button>
                                        </div>
                                        <img
                                            src="https://images.unsplash.com/photo-1577982787983-e07c6730f2d3?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2059&q=80"
                                            alt="Just a flower"
                                            class="w-full object-fill rounded-2xl"
                                        />
                                    </div>
                                    <div class="flex-auto justify-evenly">
                                        <div class="flex flex-wrap">
                                            <p
                                                class="ml-2 text-xl font-bold text-fuchsia-100 dark:text-white"
                                            >
                                                {{ product.title }}
                                            </p>
                                            <div
                                                class="flex items-center my-1 justify-end w-full"
                                            >
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5 text-yellow-400"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                    ></path>
                                                </svg>
                                                <p
                                                    class="ml-2 text-sm font-bold text-cyan-500 dark:text-white"
                                                >
                                                    {{ product.rate }}
                                                </p>
                                                <span
                                                    class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"
                                                ></span>
                                                <p
                                                    class="text-sm font-medium text-slate-400 underline hover:no-underline dark:text-white"
                                                >
                                                    {{
                                                        product.reviews
                                                    }}
                                                    reviews
                                                </p>

                                                <div
                                                    class="flex items-center bg-red-500 text-white text-sm px-2 py-1 ml-3 rounded-lg"
                                                >
                                                    %{{ product.discount }}
                                                </div>
                                                <RateButton />
                                            </div>

                                            <div
                                                class="flex items-center w-full justify-between min-w-0"
                                            >
                                                <h2
                                                    class="text-lg mr-auto cursor-pointer text-gray-200 truncate"
                                                >
                                                    {{ product.description }}
                                                </h2>
                                            </div>
                                        </div>
                                        <div
                                            class="text-xl text-yellow-600 font-semibold mt-1"
                                        >
                                            ${{ product.price }}
                                        </div>
                                        <div
                                            class="lg:flex py-4 text-sm text-gray-600"
                                        >
                                            <div
                                                class="flex-1 inbuttonne-flex items-center mb-3"
                                            >
                                                <div
                                                    class="w-full flex-none text-sm flex items-center text-gray-600"
                                                >
                                                    <ul
                                                        class="flex flex-row justify-center items-center space-x-2"
                                                    >
                                                        <button
                                                            @click="
                                                                chooseColor(
                                                                    `blue`
                                                                )
                                                            "
                                                        >
                                                            <span
                                                                :class="{
                                                                    'border-blue-500':
                                                                        picked_color ==
                                                                        `blue`,
                                                                }"
                                                                class="block p-1 border-2 border-gray-900 hover:border-blue-600 rounded-full transition ease-in duration-300"
                                                            >
                                                                <a
                                                                    class="block w-3 h-3 bg-blue-600 rounded-full"
                                                                ></a>
                                                            </span>
                                                        </button>
                                                        <button
                                                            @click="
                                                                chooseColor(
                                                                    `yellow`
                                                                )
                                                            "
                                                        >
                                                            <span
                                                                :class="{
                                                                    'border-yellow-500':
                                                                        picked_color ==
                                                                        `yellow`,
                                                                }"
                                                                class="block p-1 border-2 border-gray-900 hover:border-yellow-600 rounded-full transition ease-in duration-300"
                                                            >
                                                                <a
                                                                    class="block w-3 h-3 bg-yellow-600 rounded-full"
                                                                ></a>
                                                            </span>
                                                        </button>
                                                        <button
                                                            @click="
                                                                chooseColor(
                                                                    `red`
                                                                )
                                                            "
                                                        >
                                                            <span
                                                                :class="{
                                                                    'border-red-500':
                                                                        picked_color ==
                                                                        `red`,
                                                                }"
                                                                class="block p-1 border-2 border-gray-900 hover:border-red-600 rounded-full transition ease-in duration-300"
                                                            >
                                                                <a
                                                                    class="block w-3 h-3 bg-red-600 rounded-full"
                                                                ></a>
                                                            </span>
                                                        </button>
                                                        <button
                                                            @click="
                                                                chooseColor(
                                                                    `purple`
                                                                )
                                                            "
                                                        >
                                                            <span
                                                                :class="{
                                                                    'border-purple-500':
                                                                        picked_color ==
                                                                        `purple`,
                                                                }"
                                                                class="block p-1 border-2 border-gray-900 hover:border-purple-600 rounded-full transition ease-in duration-300"
                                                            >
                                                                <a
                                                                    class="block w-3 h-3 bg-purple-600 rounded-full"
                                                                ></a>
                                                            </span>
                                                        </button>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div
                                                class="flex-1 inbuttonne-flex items-center mb-3"
                                            >
                                                <div
                                                    class="cursor-pointer text-gray-400"
                                                >
                                                    <SizeRadio
                                                        :size="`S`"
                                                        :chosen="
                                                            picked_size == `S`
                                                        "
                                                        @selected="
                                                            chooseSize(`S`)
                                                        "
                                                    />
                                                    <SizeRadio
                                                        :size="`M`"
                                                        :chosen="
                                                            picked_size == `M`
                                                        "
                                                        @selected="
                                                            chooseSize(`M`)
                                                        "
                                                    />
                                                    <SizeRadio
                                                        :size="`L`"
                                                        :chosen="
                                                            picked_size == `L`
                                                        "
                                                        @selected="
                                                            chooseSize(`L`)
                                                        "
                                                    />
                                                    <SizeRadio
                                                        :size="`XL`"
                                                        :chosen="
                                                            picked_size == `XL`
                                                        "
                                                        @selected="
                                                            chooseSize(`XL`)
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="flex space-x-2 text-sm font-medium justify-start"
                                        >
                                            <InCartButton
                                                v-if="product.is_in_cart"
                                            />
                                            <AddToCartButton
                                                v-else
                                                :id="product.id"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
