<script setup>
import AddToCartButton from "@/Components/AddToCartButton.vue";
import ProductCard5 from "@/Components/ProductCard5.vue";
import CommentForm from "@/Pages/Store/Partial/CommentForm.vue";
import Comment from "@/Components/Comment.vue";
import { computed, ref } from "vue";
import { useProductStore } from "@/store/Product.js";
import { useCartStore } from "@/store/Cart.js";
import { onMounted } from "vue";

const storeCart = useCartStore();
const storeProduct = useProductStore();

let props = defineProps({
    similar_products: Object,
    product: Object,
    comments: Object,
});

let picked_color = ref(props.product.available_colors[0]);
let price = ref(props.product.available_colors[0].pivot.price);

let is_liked = ref(props.product.is_liked);

const chooseColor = (color) => {
    picked_color.value = color;
    price.value = color.pivot.price;
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
    storeCart.addToCart(props.product.id, picked_color.value.id);
};
onMounted(() => {
console.log(props.product
)
});
</script>


<template>
    <section>
        <div class="px-8 relative mx-auto max-w-screen-xl xl:px-24 sm:container py-8 md:mt-6 bg-gray-50">
            <div class="flex flex-col items-start gap-8 sm:flex-row">
                <div class="md:w-1/2 mx-md:auto w-full">
                    <div class="relative h-62 w-full mb-3">
                        <div v-if="$page.props.auth" class="absolute flex flex-col top-0 right-0 p-3">
                            <button v-if="is_liked" @click="unlikeProduct(product.id)"
                                class="transition ease-in duration-75 active:scale-100 hover:scale-105 bg-gray-800 hover:text-purple-500 shadow hover:shadow-md text-gray-500 rounded-full w-9 h-9 text-center pt-1.5">
                                <i class="bi bi-heart-fill text-red-600"></i>
                            </button>

                            <button v-else @click="likeProduct(product.id)"
                                class="transition ease-in duration-75 active:scale-100 hover:scale-105 bg-gray-800 hover:text-purple-500 shadow hover:shadow-md text-gray-500 rounded-full w-9 h-9 text-center pt-1.5">
                                <i class="bi bi-heart text-red-600"></i>
                            </button>
                        </div>

                        <img :src="product.image_url" alt="Just a flower"
                            class="object-contain h-full w-full sm:rounded-2xl" />
                    </div>
                    <div class="w-full ">
                        <div class="flex">
                            <div class="flex space-x-2 text-sm font-medium justify-start">
                                <Link href="/login" v-if="!$page.props.auth"
                                class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200">
                                ابتدا وارد حساب کاربری خود شوید
                                </Link>
                                <AddToCartButton v-else :id="product.id" @pressed="addToCart()" />
                            </div>
                        </div>

                    </div>
                    <div class="w-full ">
                        <div class="flow-root">
                            <div class="-m-0.5 flex flex-wrap justify-end pt-4 sm:pt-1">
                                <ul class="flex flex-wrap justify-center items-center space-x-2">
                                    <button v-for="color of product.available_colors" :key="color.id"
                                        @click="chooseColor(color)">
                                        <span :class="{
                                            'border-slate-500':
                                                picked_color.en_name ==
                                                color.en_name,
                                        }"
                                            class="block p-1 border-[0.5px] px-2 rounded-full transition ease-in duration-100">
                                            <div class="flex gap-1">
                                                <span :style="{
                                                    backgroundColor:
                                                        color.en_name,
                                                }" class="block w-6 h-6 rounded-full border"></span>
                                                <p v-text="color.fa_name"></p>
                                            </div>
                                        </span>
                                    </button>
                                </ul>
                            </div>
                        </div>



                    </div>
                </div>

                <div class="sticky top-2 md:w-1/2 w-full">
                    <div class="mt-8 w-full ">
                        <div class="justify-between flex">
                            <h3 class="text-xl text-yellow-800 font-semibold mt-1">
                                {{ price.toLocaleString("ar-EG") }}
                                <span class="text-stone-800">تومان</span>
                            </h3>

                            <h1 class="text-2xl font-bold pb-2">
                                {{ product.title }}
                            </h1>
                        </div>
                        <h4 class="text-slate-800 font-extralight break-words lg:pt-6">
                            {{ product.details }}
                        </h4>

                        <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                        <div class="flex gap-2 items-center justify-end">
                            <p class="text-sm font-medium text-slate-700 underline hover:no-underline dark:text-white">
                                {{ product.reviews }}
                                بازدید
                            </p>
                            <div class="mt-2 -ml-0.5 flex justify-end">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>

                                <p class="text-md font-bold text-cyan-700 dark:text-white">
                                    {{ product.rate }}
                                </p>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                    <div class="my-6 text-slate-700">
                        <h2 class="text-xl">ویژگی ها</h2>
                        <div v-for="attr of props.product.attributes" :key="attr.product_id"
                            class="flex items-center mt-4 text-gray-700 text-right justify-end">
                            <p class="px-2 text-sm text-blue-700" v-text="attr.value"></p>
                            <p class="px-2 text-sm" v-text="attr.title"></p>
                            <span class="w-2 h-2 bg-slate-500 rounded-full"></span>
                        </div>
                    </div>
                    <div class="my-4 text-slate-700">
                        <h2 class="text-xl p-2">توضیحات</h2>
                        <p class="text-slate-600  break-words">
                            {{ product.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lg:py-16 flex flex-col justify-center items-center" v-if="Object.keys(product.comments).length != 0">
        <CommentForm :product_id="product.id" />
        <div v-if="$page.props.auth" class="lg:w-1/2 w-full px-4 lg:py-6">
            <div class="flex justify-between items-center space-x-2">

                <h2 class="text-lg p-4 font-bold text-blue-900 dark:text-white">
                    <span class="px-2">{{ (Object.keys(product.comments).length).toLocaleString("ar-EG") }} </span>
                    <span>نظر</span>
                </h2>
                <h2 class="text-lg lg:text-xl p-4 font-bold text-gray-700 dark:text-white">
                    دیدگاه کاربران
                </h2>
            </div>
            <Comment v-for="comment of product.comments" :key="comment.id" :comment="comment" />
        </div>
    </section>
    <section class="text-gray-600 body-font bg-stone-100">
        <div class="container px-5 pb-40 mx-auto">
            <div class="py-10  flex flex-col justify-center items-end">
                <h1 class="text-xl lg:pr-36">
                    محصولات مشابه
                </h1>
            </div>
            <div class="flex flex-wrap -m-4 justify-center">
                <ProductCard5 v-for="product of similar_products" :key="product.id" :product="product" />
            </div>
        </div>
    </section>
</template>
<style scoped>
.picked-color {
    border-color: v-bind(color);
}
</style>
