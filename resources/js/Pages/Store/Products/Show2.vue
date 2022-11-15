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
    product: Object,
    comments: Object,
});

// let picked_color = ref(props.product.availableColors[0]);
let picked_color = ref("");
let is_liked = ref(props.product.is_liked);

const chooseColor = (color) => {
    picked_color.value = color;
};

// let picked_size = ref(props.product.availableSizes[0]);
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

const order_form = useForm({
    product_id: props.product.id,
    color: picked_color.value,
    size: picked_size.value
});

const addToCart = () => {
    props.product.is_in_cart = true;
    storeCart.addToCart(props.product.id)

    // order_form.post(route('product.store'), {
    //     preserveScroll: true,
    //     onSuccess: () => {
    //         props.product.is_in_cart = true;
    //     },
    // });

};
</script>


<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    layout: AppLayout,
}
</script>


<template>


    <section>
        <div class="relative mx-auto max-w-screen-xl xl:px-24 px-4 py-8 bg-gray-100">
            <div class="grid grid-cols-1 items-start gap-8 sm:grid-cols-2">
                <div class="w-full sm:1/3">
                    <div class="relative h-62 w-full mb-3">
                        <div class="absolute flex flex-col top-0 right-0 p-3">
                            <button v-if="is_liked" @click="
                                unlikeProduct(product.id)
                            "
                                class="transition ease-in duration-75 active:scale-100 hover:scale-105 bg-gray-800 hover:text-purple-500 shadow hover:shadow-md text-gray-500 rounded-full w-9 h-9 text-center p-1">
                                <i class="bi bi-heart-fill text-red-600"></i>
                            </button>

                            <button v-else @click="likeProduct(product.id)"
                                class="transition ease-in duration-75 active:scale-100 hover:scale-105 bg-gray-800 hover:text-purple-500 shadow hover:shadow-md text-gray-500 rounded-full w-9 h-9 text-center p-1">
                                <i class="bi bi-heart text-red-600"></i>
                            </button>
                        </div>
                        <img :src="product.image_url" alt="Just a flower" class="w-full object-fill sm:rounded-2xl" />

                    </div>
                </div>

                <div class="sticky top-0">
                    <strong
                        class="rounded-full border bg-gray-800 px-3 py-0.5 text-xs font-medium tracking-wide text-[#e8a138]">
                        Pre Order
                    </strong>

                    <div class="mt-8 flex justify-between">
                        <div class="max-w-[35ch]">
                            <h1 class="text-2xl font-bold">
                                {{ product.title }}
                            </h1>


                            <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                            <p class="text-sm font-medium text-slate-800 underline hover:no-underline dark:text-white">
                                {{
                                        product.reviews
                                }}
                                reviews
                            </p>
                            <div class="mt-2 -ml-0.5 flex">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>

                                <p class=" text-sm font-bold text-cyan-700 dark:text-white">
                                    {{ product.rate }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <div class="text-xl text-yellow-600 font-semibold mt-1">
                                $ {{ product.sale_price }}
                            </div>
                            <span class="text-red-400 line-through text-sm">$ {{ product.price }}</span>
                        </div>
                    </div>

                    <details class="group relative mt-4">
                        <summary class="block">
                            <div>
                                <div class="prose max-w-none group-open:hidden">
                                    <p>
                                        {{ product.description }}
                                    </p>
                                </div>

                                <span
                                    class="mt-4 cursor-pointer text-sm font-medium underline group-open:absolute group-open:bottom-0 group-open:left-0 group-open:mt-0">
                                    Read More
                                </span>
                            </div>
                        </summary>

                        <div class="prose max-w-none pb-6">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa
                                veniam dicta beatae eos ex error culpa delectus rem tenetur,
                                architecto quam nesciunt, dolor veritatis nisi minus inventore,
                                rerum at recusandae?
                            </p>

                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat
                                nam sapiente nobis ea veritatis error consequatur nisi
                                exercitationem iure laudantium culpa, animi temporibus non! Maxime
                                et quisquam amet. A, deserunt!
                            </p>
                        </div>
                    </details>

                    <form class="mt-8">
                        <fieldset>
                            <legend class="mb-1 text-sm font-medium">Color</legend>

                            <div class="flow-root">
                                <div class="-m-0.5 flex flex-wrap">
                                    <ul class="flex flex-row justify-center items-center space-x-2">


                                        <!-- gotta loop here for available colors -->


                                        <button @click="
                                            chooseColor(
                                                `blue`
                                            )
                                        ">
                                            <span :class="{
                                                'border-blue-500':
                                                    picked_color ==
                                                    `blue`,
                                            }"
                                                class="block p-1 border-2  hover:border-blue-600 rounded-full transition ease-in duration-300">
                                                <a class="block w-3 h-3 bg-blue-600 rounded-full"></a>
                                            </span>
                                        </button>
                                        <button @click="
                                            chooseColor(
                                                `yellow`
                                            )
                                        ">
                                            <span :class="{
                                                'border-yellow-500':
                                                    picked_color ==
                                                    `yellow`,
                                            }"
                                                class="block p-1 border-2  hover:border-yellow-600 rounded-full transition ease-in duration-300">
                                                <a class="block w-3 h-3 bg-yellow-600 rounded-full"></a>
                                            </span>
                                        </button>
                                        <button @click="
                                            chooseColor(
                                                `red`
                                            )
                                        ">
                                            <span :class="{
                                                'border-red-500':
                                                    picked_color ==
                                                    `red`,
                                            }"
                                                class="block p-1 border-2  hover:border-red-600 rounded-full transition ease-in duration-300">
                                                <a class="block w-3 h-3 bg-red-600 rounded-full"></a>
                                            </span>
                                        </button>
                                        <button @click="
                                            chooseColor(
                                                `purple`
                                            )
                                        ">
                                            <span :class="{
                                                'border-purple-500':
                                                    picked_color ==
                                                    `purple`,
                                            }"
                                                class="block p-1 border-2  hover:border-purple-600 rounded-full transition ease-in duration-300">
                                                <a class="block w-3 h-3 bg-purple-600 rounded-full"></a>
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
                                    <SizeRadio :size="`S`" :chosen="
                                        picked_size == `S`
                                    " @selected="chooseSize(`S`)" />
                                    <SizeRadio :size="`M`" :chosen="
                                        picked_size == `M`
                                    " @selected="chooseSize(`M`)" />
                                    <SizeRadio :size="`L`" :chosen="
                                        picked_size == `L`
                                    " @selected="chooseSize(`L`)" />
                                    <SizeRadio :size="`XL`" :chosen="
                                        picked_size == `XL`
                                    " @selected="chooseSize(`XL`)" />
                                </div>
                            </div>
                        </fieldset>

                        <div class="mt-8 flex">
                            <div class="flex space-x-2 text-sm font-medium justify-start">
                                <Link href="/login" v-if="!$page.props.auth"
                                    class="transition ease-in duration-300 inbuttonne-flex items-center text-sm font-medium mb-2 md:mb-0 bg-cyan-500 px-5 py-2 hover:shadow-lg tracking-wider text-gray-900 rounded-full hover:bg-cyan-600">
                                Log in to access your cart
                                </Link>
                                <InCartButton v-else-if="product.is_in_cart" @addanother="addToCart()" />
                                <AddToCartButton v-else :id="product.id" @pressed="addToCart()" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


</template>
