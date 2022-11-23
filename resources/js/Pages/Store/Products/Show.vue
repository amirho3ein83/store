<script setup>
import AddToCartButton from "@/Components/AddToCartButton.vue";
import InCartButton from "@/Components/InCartButton.vue";
import CommentForm from "@/Pages/Store/Partial/CommentForm.vue";
import SizeRadio from "@/Components/SizeRadio.vue";
import Comment from "@/Components/Comment.vue";
import { ref } from "vue";
import { useProductStore } from "@/store/Product.js";
import { useCartStore } from "@/store/Cart.js";

const storeCart = useCartStore();
const storeProduct = useProductStore();

let props = defineProps({
    // similar_products: Object,
    product: Object,
    comments: Object,
});

let picked_color = ref(props.product.attributes[0].color);

let is_liked = ref(props.product.is_liked);

const chooseColor = (color) => {
    picked_color.value = color;
};

let picked_size = ref(props.product.attributes[0].size);

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

const addToCart = () => {
    storeCart.addToCart(
        props.product.id,
        picked_color.value,
        picked_size.value
    );
};
</script>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    layout: AppLayout,
};
</script>

<template>
    <section>
        <div
            class="px-8 relative mx-auto max-w-screen-xl xl:px-24 sm:container py-8 bg-gray-100"
        >
            <div class="flex flex-col items-start gap-8 sm:flex-row">
                <div class="md:w-1/2 mx-md:auto w-full">
                    <div class="relative h-62 w-full mb-3">
                        <div
                            v-if="$page.props.auth"
                            class="absolute flex flex-col top-0 right-0 p-3"
                        >
                            <button
                                v-if="is_liked"
                                @click="unlikeProduct(product.id)"
                                class="transition ease-in duration-75 active:scale-100 hover:scale-105 bg-gray-800 hover:text-purple-500 shadow hover:shadow-md text-gray-500 rounded-full w-9 h-9 text-center p-1"
                            >
                                <i class="bi bi-heart-fill text-red-600"></i>
                            </button>

                            <button
                                v-else
                                @click="likeProduct(product.id)"
                                class="transition ease-in duration-75 active:scale-100 hover:scale-105 bg-gray-800 hover:text-purple-500 shadow hover:shadow-md text-gray-500 rounded-full w-9 h-9 text-center p-1"
                            >
                                <i class="bi bi-heart text-red-600"></i>
                            </button>
                        </div>
                        <img
                            :src="product.image_url"
                            alt="Just a flower"
                            class="object-contain h-full w-full sm:rounded-2xl"
                        />
                    </div>
                </div>

                <div class="sticky top-2 md:w-1/2 w-full">
                    <strong
                        v-if="product.featured"
                        class="rounded-full border bg-gray-700 px-3 py-1 text-xs font-medium tracking-wide text-[#37fa51]"
                    >
                        Featured Order
                    </strong>

                    <div class="mt-8 flex justify-between">
                        <div class="max-w-[35ch]">
                            <h1 class="text-2xl font-bold pb-2">
                                {{ product.title }}
                            </h1>
                            <h1 class="text-sm font-thin">
                                Brand:
                                <span class="text-indigo-700">{{
                                    product.brand.name
                                }}</span>
                            </h1>
                            <h4 class="text-slate-600 font-extralight">
                                {{ product.details }}
                            </h4>

                            <span
                                class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"
                            ></span>
                            <p
                                class="text-sm font-medium text-slate-800 underline hover:no-underline dark:text-white"
                            >
                                {{ product.reviews }}
                                reviews
                            </p>
                            <div class="mt-2 -ml-0.5 flex">
                                <svg
                                    class="h-5 w-5 text-yellow-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                    />
                                </svg>

                                <p
                                    class="text-sm font-bold text-cyan-700 dark:text-white"
                                >
                                    {{ product.rate }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <div
                                class="text-xl text-yellow-600 font-semibold mt-1"
                            >
                                $ {{ product.default_price }}
                            </div>
                            <!-- <span
                                v-if="product.default_price != product.price"
                                class="text-red-400 line-through text-sm"
                                >$ {{ product.price }}</span
                            > -->
                        </div>
                    </div>

                    <p class="my-4">
                        {{ product.description }}
                    </p>
                    <!-- <p class="my-4">
                        {{ product.attributes }}
                    </p> -->

                    <fieldset>
                        <legend class="mt-3 text-sm font-medium">Color</legend>

                        <div class="flow-root">
                            <div class="-m-0.5 flex flex-wrap">
                                <ul
                                    class="flex flex-row justify-center items-center space-x-2"
                                >
                                    <button
                                        v-for="attribute of product.attributes"
                                        :key="attribute.color"
                                        @click="chooseColor(attribute.color)"
                                    >
                                        <span
                                            :class="{
                                                'border-blue-600':
                                                    picked_color ==
                                                    attribute.color,
                                            }"
                                            class="block p-1 border-2 hover:border-blue-600 rounded-full transition ease-in duration-300"
                                        >
                                            <a
                                                :style="{
                                                    backgroundColor:
                                                        attribute.color,
                                                }"
                                                class="block w-3 h-3 rounded-full"
                                            ></a>
                                        </span>
                                    </button>
                                </ul>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="mt-4">
                        <legend class="mb-1 text-sm font-medium">Size</legend>

                        <div class="flow-root">
                            <div class="-m-0.5 flex flex-wrap">
                                <SizeRadio
                                    v-for="attribute of product.attributes"
                                    :key="attribute.size"
                                    :size="attribute.size"
                                    :chosen="picked_size == attribute.size"
                                    @selected="chooseSize(attribute.size)"
                                />
                            </div>
                        </div>
                    </fieldset>

                    <div class="mt-8 flex">
                        <div
                            class="flex space-x-2 text-sm font-medium justify-start"
                        >
                            <Link
                                href="/login"
                                v-if="!$page.props.auth"
                                class="transition ease-in duration-300 inbuttonne-flex items-center text-sm font-medium mb-2 md:mb-0 bg-cyan-500 px-5 py-2 hover:shadow-lg tracking-wider text-gray-900 rounded-full hover:bg-cyan-600"
                            >
                                Log in to access your cart
                            </Link>
                            <AddToCartButton
                                v-else
                                :id="product.id"
                                @pressed="addToCart()"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <h3>similar</h3>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-12 mx-auto">
            <div class="flex flex-wrap -m-4">
                <div
                    v-for="product of similar_products"
                    :key="product.id"
                    @click="storeProduct.showProduct(product.slug)"
                    class="xl:w-1/4 md:w-1/2 p-4"
                >
                    <img
                        alt="image"
                        :src="product.image_url"
                        class="w-full object-cover"
                    />
                    <div class="mt-2 space-y-3">
                        <div class="flex justify-between text-sm truncate">
                            <h3>{{ product.title }}</h3>

                            <p
                                class="ml-2 text-sm font-bold text-yellow-700 dark:text-white"
                            >
                                {{ product.rate
                                }}<i
                                    class="bi bi-star-fill text-yellow-500"
                                ></i>
                            </p>
                        </div>
                        <div class="flex justify-between text-xs">
                            <div class="flex gap-1">
                                <span
                                    :style="{ backgroundColor: color.name }"
                                    v-for="color of product.available_colors"
                                    :key="color.id"
                                    class="block h-3 w-3 shadow rounded-full"
                                >
                                </span>
                            </div>
                            <p class="text-yellow-800">
                                ${{ product.default_price }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> -->
</template>
<style scoped>
.picked-color {
    border-color: v-bind(color);
}
</style>
