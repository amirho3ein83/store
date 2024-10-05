<script setup>
import { Head, Link, usePage } from "@inertiajs/inertia-vue3";
import Hero2 from "@/Components/Hero2.vue";
import HeroSlider from "@/Components/HeroSlider.vue";
import "vue-horizontal-scroll/dist/vue-horizontal-scroll.css";
import CategoryItem from "@/Components/CategoryItem.vue";
import { OrbitSpinner } from "epic-spinners";
import { useCartStore } from "@/store/Cart.js";
import { computed, onMounted } from "vue";
import Footer from "../Footer.vue";

const storeCart = useCartStore();

defineProps({
    amazing_offers: Object,
    categories: Object,
});


onMounted(() => {
    if (usePage().props.value.auth) {
        storeCart.countOrders();
    }
});

</script>

<template>
    <Head title="Store Page" />
    <div class="carousel relative container mx-auto" style="max-width: 1600px"></div>
    <section class="">
        <div class=" relative overflow-hidden bg-no-repeat bg-cover min-h-screen" style="
                        background-position: 50%;
                        background-image: url('https://cdn.wallpapersafari.com/4/2/ymKADb.jpg');
                        height: 500px;
                    ">
            <header class="absolute inset-x-0 top-0 z-50">
                <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                    <div class="flex lg:flex-1">

                        <div class="flex items-center space-x-4 ">
                            <Link href="/home" preserve-scroll>
                            <OrbitSpinner :animation-duration="3000" :size="40" color="#feffd4" />

                            </Link>
                            <div class="font-medium dark:text-white">
                                <p class="text-slate-100 text-lg">Space Store</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex lg:hidden">
                        <button type="button"
                            class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                            <span class="sr-only">Open main menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                    <div class="hidden lg:flex lg:gap-x-12">
                        <Link href="/home" preserve-scroll>
                        <p class="text-md font-sans leading-6 text-gray-50">Home</p>
                        </Link>
                        <Link :href="route(`category.list`)" preserve-scroll>
                        <p class="text-md font-sans leading-6 text-gray-50">Categories</p>
                        </Link>
                        <Link href="/contact-us" preserve-scroll>
                        <p class="text-md font-sans leading-6 text-gray-50">Contact us</p>
                        </Link>

                    </div>

                    <div v-if="$page.props.auth" class="hidden lg:flex lg:flex-1 lg:justify-end">


                        <Link :href="route('user.profile')" class="text-gray-100 px-3 duration-100 hover:opacity-80">

                        <div class="flex items-center space-x-4">
                            <div class="font-medium dark:text-white">
                                <p class="text-slate-50">{{ $page.props.user.name }}</p>
                                <p class="text-slate-300 text-xs">{{ $page.props.user.email ?? null }}</p>
                            </div>
                        <img v-if="$page.props.user.avatar_url" class="w-10 h-10 rounded-full"
                            :src="$page.props.user.avatar_url" alt="profile">
                        <img v-else class="w-10 h-10 rounded-full"
                            src="https://img.freepik.com/premium-vector/man-avatar-profile-picture-vector-illustration_268834-538.jpg"
                            alt="profile">
                    </div>
                    </Link>
                </div>

                <div v-else class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <Link href="/login" class="text-gray-100 px-3 ">

                    <p class="text-md font-sans leading-6 text-gray-200">sign in</p>
                    </Link>
                    <Link href="/register" class="text-gray-100 px-3 ">

                    <p class="text-md font-sans leading-6 text-gray-200">sign up</p>
                    </Link>
                </div>
            </nav>
            <!-- Mobile menu, show/hide based on menu open state. -->
            <div class="lg:hidden" role="dialog" aria-modal="true">


                <!-- Background backdrop, show/hide based on slide-over state. -->
                <div class="fixed inset-0 z-50"></div>
                <!-- <div
                        class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                        <div class="flex items-center justify-between">
                            <a href="#" class="-m-1.5 p-1.5">
                                <span class="sr-only">Your Company</span>
                                <img class="h-8 w-auto"
                                    src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
                            </a>
                            <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                                        <span class="sr-only">Close menu</span>
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="mt-6 flow-root">
                                    <div class="-my-6 divide-y divide-gray-500/10">
                                        <div class="space-y-2 py-6">
                                            <a href="#"
                                                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-200 hover:bg-gray-50">Product</a>
                                            <a href="#"
                                                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-200 hover:bg-gray-50">Features</a>
                                            <a href="#"
                                                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-200 hover:bg-gray-50">Marketplace</a>
                                            <a href="#"
                                                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-200 hover:bg-gray-50">Company</a>
                                        </div>
                                        <div class="py-6">
                                            <a href="#"
                                                class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-200 hover:bg-gray-50">Log
                                                in</a>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                </div>
            </header>

            <div class="relative isolate px-6 pt-14 lg:px-8">
                <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                    aria-hidden="true">
                    <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                    </div>
                </div>
                <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                    <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                        <div
                            class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-200 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                            Announcing our next round of funding. <a href="#" class="font-semibold text-indigo-600"><span
                                    class="absolute inset-0" aria-hidden="true"></span>Read more <span
                                    aria-hidden="true">&rarr;</span></a>
                        </div>
                    </div>
                    <div class="text-center">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-100 sm:text-6xl">To explore Space Store </h1>
                        <p class="mt-6 text-lg leading-8 text-gray-100">Anim aute id magna aliqua ad ad non deserunt
                            sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat
                            aliqua.</p>

                    </div>
                </div>
                <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                    aria-hidden="true">
                    <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                    </div>
                </div>
            </div>

        </div>

        <section class="text-gray-600 body-font  lg:py-8">
            <div class="container px-5 py-12 mx-auto">
                <div class="flex flex-wrap -m-4">
                    <CategoryItem v-for="category of categories" :key="category.id" :category="category"
                        :path="`subCategories.list`" />
                </div>
            </div>
        </section>



        <HeroSlider />





    <!-- 

        <div>

            <div :class="cartOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'"
                class="fixed right-0 top-0 max-w-xs w-full h-full px-6 py-4 transition duration-300 transform overflow-y-auto  border-l-2 border-gray-300">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-medium text-gray-700">Your cart</h3>
                    <button @click="cartOpen = !cartOpen" class="text-gray-600 focus:outline-none">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <hr class="my-3">
                <div class="flex justify-between mt-6">
                    <div class="flex">
                        <img class="h-20 w-20 object-cover rounded"
                            src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80"
                            alt="">
                        <div class="mx-3">
                            <h3 class="text-sm text-gray-600">Mac Book Pro</h3>
                            <div class="flex items-center mt-2">
                                <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                                <span class="text-gray-700 mx-2">2</span>
                                <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <span class="text-gray-600">20$</span>
                </div>
                <div class="flex justify-between mt-6">
                    <div class="flex">
                        <img class="h-20 w-20 object-cover rounded"
                            src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80"
                            alt="">
                        <div class="mx-3">
                            <h3 class="text-sm text-gray-600">Mac Book Pro</h3>
                            <div class="flex items-center mt-2">
                                <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                                <span class="text-gray-700 mx-2">2</span>
                                <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <span class="text-gray-600">20$</span>
                </div>
                <div class="flex justify-between mt-6">
                    <div class="flex">
                        <img class="h-20 w-20 object-cover rounded"
                            src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80"
                            alt="">
                        <div class="mx-3">
                            <h3 class="text-sm text-gray-600">Mac Book Pro</h3>
                            <div class="flex items-center mt-2">
                                <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                                <span class="text-gray-700 mx-2">2</span>
                                <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <span class="text-gray-600">20$</span>
                </div>
                <div class="mt-8">
                    <form class="flex items-center justify-center">
                        <input class="form-input w-48" type="text" placeholder="Add promocode">
                        <button
                            class="ml-3 flex items-center px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            <span>Apply</span>
                        </button>
                    </form>
                </div>
                <a
                    class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                    <span>Chechout</span>
                    <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
            <main class="my-8">
                <div class="container mx-auto px-6">
                    <div class="h-64 rounded-md overflow-hidden bg-cover bg-center"
                        style="background-image: url('https://images.unsplash.com/photo-1577655197620-704858b270ac?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1280&q=144')">
                        <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                            <div class="px-10 max-w-xl">
                                <h2 class="text-2xl text-white font-semibold">Sport Shoes</h2>
                                <p class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                    Tempore facere provident molestias ipsam sint voluptatum pariatur.</p>
                                <button
                                    class="flex items-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                    <span>Shop Now</span>
                                    <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="md:flex mt-8 md:-mx-4">
                        <div class="w-full h-64 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:w-1/2"
                            style="background-image: url('https://images.unsplash.com/photo-1547949003-9792a18a2601?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80')">
                            <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                                <div class="px-10 max-w-xl">
                                    <h2 class="text-2xl text-white font-semibold">Back Pack</h2>
                                    <p class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                        Tempore facere provident molestias ipsam sint voluptatum pariatur.</p>
                                    <button
                                        class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                                        <span>Shop Now</span>
                                        <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                            <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            </div>
                            <div class="w-full h-64 mt-8 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:mt-0 md:w-1/2"
                                style="background-image: url('https://images.unsplash.com/photo-1486401899868-0e435ed85128?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80')">
                                <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                                    <div class="px-10 max-w-xl">
                                        <h2 class="text-2xl text-white font-semibold">Games</h2>
                                        <p class="mt-2 text-gray-400">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                            Tempore facere provident molestias ipsam sint voluptatum pariatur.</p>
                                        <button
                                            class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                                            <span>Shop Now</span>
                                            <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </main>


            </div>
     -->


        <!-- Features Section: Boxes with Icons -->
        <div class=" dark:text-gray-100 dark:from-indigo-900 dark:via-purple-900 dark:to-teal-900">
            <div class="container xl:max-w-7xl mx-auto px-4 py-16 lg:px-8 lg:py-32">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <div
                        class="p-5 md:p-7 xl:p-10  border border-white shadow-sm rounded-lg transition hover:border-blue-600 dark:bg-gray-800 dark:border-gray-800 dark:hover:border-blue-400 dark:shadow-none">
                        <svg class="hi-outline hi-rectangle-stack inline-block w-12 h-12 text-blue-600 mb-5 dark:text-blue-500"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>
                        <h4 class="text-lg font-bold mb-2">
                            1. UI Components Library
                        </h4>
                        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
                            We carefully handcrafted a vast collection of UI components to build all kinds of web
                            applications and websites. We keep designing and adding new ones with each update.
                        </p>
                    </div>
                    <div
                        class="p-5 md:p-7 xl:p-10  border border-white shadow-sm rounded-lg transition hover:border-blue-600 dark:bg-gray-800 dark:border-gray-800 dark:hover:border-blue-400 dark:shadow-none">
                        <svg class="hi-outline hi-cube inline-block w-12 h-12 text-blue-600 mb-5 dark:text-blue-500"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                        <h4 class="text-lg font-bold mb-2">
                            2. Self-Hosted Web App
                        </h4>
                        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
                            You’ll love working with the Tailkit web app! It’s a compiled Vue.js based app which you can
                            host on your own and use to explore and use all available UI components.
                        </p>
                    </div>
                    <div
                        class="p-5 md:p-7 xl:p-10  border border-white shadow-sm rounded-lg transition hover:border-blue-600 sm:col-span-2 lg:col-span-1 dark:bg-gray-800 dark:border-gray-800 dark:hover:border-blue-400 dark:shadow-none">
                        <svg class="hi-outline hi-cog inline-block w-12 h-12 text-blue-600 mb-5 dark:text-blue-500"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                        </svg>
                        <h4 class="text-lg font-bold mb-2">
                            3. Helper Tools
                        </h4>
                        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
                            Search and copy SVG icons, build your button markup or copy your favorite color classes with
                            powerful tools. More are under development to give you superpowers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <section class=" dark:bg-gray-900">
            <div class="container px-6 py-10 mx-auto">
                <div class="text-center">
                    <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">From the blog
                    </h1>

                    <p class="max-w-lg mx-auto mt-4 text-gray-500">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure veritatis sint autem nesciunt,
                        laudantium
                        quia tempore delect
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 mt-8 lg:grid-cols-2">
                    <article class="flex bg-white transition hover:shadow-xl">
                        <div class="rotate-180 p-2 [writing-mode:_vertical-lr]">
                            <time datetime="2022-10-10"
                                class="flex items-center justify-between gap-4 text-xs font-bold uppercase text-gray-900">
                                <span>2022</span>
                                <span class="w-px flex-1 bg-gray-900/10"></span>
                                <span>Oct 10</span>
                            </time>
                        </div>

                        <div class="hidden sm:block sm:basis-56">
                            <img alt="Guitar"
                                src="https://images.unsplash.com/photo-1609557927087-f9cf8e88de18?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80"
                                class="aspect-square h-full w-full object-cover" />
                        </div>

                        <div class="flex flex-1 flex-col justify-between">
                            <div class="border-s border-gray-900/10 p-4 sm:border-l-transparent sm:p-6">
                                <a href="#">
                                    <h3 class="font-bold uppercase text-gray-900">
                                        Finding the right guitar for your style - 5 tips
                                    </h3>
                                </a>

                                <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-700">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae
                                    dolores, possimus pariatur animi temporibus nesciunt praesentium dolore
                                    sed nulla ipsum eveniet corporis quidem, mollitia itaque minus soluta,
                                    voluptates neque explicabo tempora nisi culpa eius atque dignissimos.
                                    Molestias explicabo corporis voluptatem?
                                </p>
                            </div>

                            <div class="sm:flex sm:items-end sm:justify-end">
                                <a href="#"
                                    class="block bg-yellow-300 px-5 py-3 text-center text-xs font-bold uppercase text-gray-900 transition hover:bg-yellow-400">
                                    Read Blog
                                </a>
                            </div>
                        </div>
                    </article>

                    <article class="flex bg-white transition hover:shadow-xl">
                        <div class="rotate-180 p-2 [writing-mode:_vertical-lr]">
                            <time datetime="2022-10-10"
                                class="flex items-center justify-between gap-4 text-xs font-bold uppercase text-gray-900">
                                <span>2022</span>
                                <span class="w-px flex-1 bg-gray-900/10"></span>
                                <span>Oct 10</span>
                            </time>
                        </div>

                        <div class="hidden sm:block sm:basis-56">
                            <img alt="Guitar"
                                src="https://images.unsplash.com/photo-1609557927087-f9cf8e88de18?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80"
                                class="aspect-square h-full w-full object-cover" />
                        </div>

                        <div class="flex flex-1 flex-col justify-between">
                            <div class="border-s border-gray-900/10 p-4 sm:border-l-transparent sm:p-6">
                                <a href="#">
                                    <h3 class="font-bold uppercase text-gray-900">
                                        Finding the right guitar for your style - 5 tips
                                    </h3>
                                </a>

                                <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-700">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae
                                    dolores, possimus pariatur animi temporibus nesciunt praesentium dolore
                                    sed nulla ipsum eveniet corporis quidem, mollitia itaque minus soluta,
                                    voluptates neque explicabo tempora nisi culpa eius atque dignissimos.
                                    Molestias explicabo corporis voluptatem?
                                </p>
                            </div>

                            <div class="sm:flex sm:items-end sm:justify-end">
                                <a href="#"
                                    class="block bg-yellow-300 px-5 py-3 text-center text-xs font-bold uppercase text-gray-900 transition hover:bg-yellow-400">
                                    Read Blog
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
        <!-- Container for demo purpose -->
        <div class="container my-24 mx-auto md:px-6">
            <!-- Section: Design Block -->
            <section class="mb-32">
                <h2 class="mb-16 text-center text-2xl font-bold">Latest articles</h2>

                <div class="mb-16 flex flex-wrap">
                    <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pr-6">
                        <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg dark:shadow-black/20"
                            data-te-ripple-init data-te-ripple-color="light">
                            <img src="https://cdn.iranhotelonline.com/Content/Images/Gallery/73572.jpg" class="w-full" alt="Louvre" />
                            <a href="#!">
                                <div
                                    class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100">
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pl-6">
                        <h3 class="mb-4 text-2xl font-bold">That's the news!</h3>
                        <div class="mb-4 flex items-center text-sm font-medium text-danger dark:text-danger-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="mr-2 h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 01-1.161.886l-.143.048a1.107 1.107 0 00-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 01-1.652.928l-.679-.906a1.125 1.125 0 00-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 00-8.862 12.872M12.75 3.031a9 9 0 016.69 14.036m0 0l-.177-.529A2.25 2.25 0 0017.128 15H16.5l-.324-.324a1.453 1.453 0 00-2.328.377l-.036.073a1.586 1.586 0 01-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 01-5.276 3.67m0 0a9 9 0 01-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                            </svg>
                            Travels
                        </div>
                        <p class="mb-6 text-sm text-neutral-500 dark:text-neutral-400">
                            Published <u>14.01.2022</u> by
                            <a href="#!">Lisa McCartney</a>
                        </p>
                        <p class="mb-6 text-neutral-500 dark:text-neutral-300">
                            Ut pretium ultricies dignissim. Sed sit amet mi eget urna placerat
                            vulputate. Ut vulputate est non quam dignissim elementum. Donec a
                            ullamcorper diam.
                        </p>
                        <p class="text-neutral-500 dark:text-neutral-300">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quae
                            nulla saepe rerum aspernatur odio amet perferendis tempora
                            mollitia? Ratione unde magni omnis quaerat blanditiis cumque
                            dolore placeat rem dignissimos?
                        </p>
                    </div>
                </div>

                <div class="mb-16 flex flex-wrap lg:flex-row-reverse">
                    <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pl-6">
                        <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg dark:shadow-black/20"
                            data-te-ripple-init data-te-ripple-color="light">
                            <img src="https://cdn.mehrbooking.net/general/images/Hotels/yazd-mozafar-traditional-hotel-lobby.jpg" class="w-full" alt="Louvre" />
                            <a href="#!">
                                <div
                                    class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100">
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pr-6">
                        <h3 class="mb-4 text-2xl font-bold">Exhibition in Paris</h3>
                        <div class="mb-4 flex items-center text-sm font-medium text-primary dark:text-primary-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="mr-2 h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" />
                            </svg>
                            Art
                        </div>
                        <p class="mb-6 text-sm text-neutral-500 dark:text-neutral-400">
                            Published <u>12.01.2022</u> by
                            <a href="#!">Anna Doe</a>
                        </p>
                        <p class="text-neutral-500 dark:text-neutral-300">
                            Duis sagittis, turpis in ullamcorper venenatis, ligula nibh porta
                            dui, sit amet rutrum enim massa in ante. Curabitur in justo at
                            lorem laoreet ultricies. Nunc ligula felis, sagittis eget nisi
                            vitae, sodales vestibulum purus. Vestibulum nibh ipsum, rhoncus
                            vel sagittis nec, placerat vel justo. Duis faucibus sapien eget
                            tortor finibus, a eleifend lectus dictum. Cras tempor convallis
                            magna id rhoncus. Suspendisse potenti. Nam mattis faucibus
                            imperdiet. Proin tempor lorem at neque tempus aliquet. Phasellus
                            at ex volutpat, varius arcu id, aliquam lectus. Vestibulum mattis
                            felis quis ex pharetra luctus. Etiam luctus sagittis massa, sed
                            iaculis est vehicula ut.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap">
                    <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pr-6">
                        <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg dark:shadow-black/20"
                            data-te-ripple-init data-te-ripple-color="light">
                            <img src="https://iranontour.com/wp-content/uploads/2021/04/Yazd-Attraction-h.jpg" class="w-full" alt="Louvre" />
                            <a href="#!">
                                <div
                                    class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100">
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pl-6">
                        <h3 class="mb-4 text-2xl font-bold">Stock market boom</h3>
                        <div class="mb-4 flex items-center text-sm font-medium text-yellow-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="mr-2 h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                            </svg>
                            Business
                        </div>
                        <p class="mb-6 text-sm text-neutral-500 dark:text-neutral-400">
                            Published <u>10.01.2022</u> by
                            <a href="#!">Joe Svan</a>
                        </p>
                        <p class="text-neutral-500 dark:text-neutral-300">
                            Sed sollicitudin purus sed nulla dignissim ullamcorper. Aenean
                            tincidunt vulputate libero, nec imperdiet sapien pulvinar id.
                            Nullam scelerisque odio vel lacus faucibus, tincidunt feugiat
                            augue ornare. Proin ac dui vel lectus eleifend vestibulum et
                            lobortis risus. Nullam in commodo sapien. Curabitur ut erat congue
                            sem finibus eleifend egestas eu metus. Sed ut dolor id magna
                            rutrum ultrices ut eget libero. Duis vel porttitor odio. Ut
                            pulvinar sed turpis ornare tincidunt. Donec luctus, mi euismod
                            dignissim malesuada, lacus lorem commodo leo, tristique blandit
                            ante mi id metus. Integer et vehicula leo, vitae interdum lectus.
                            Praesent nulla purus, commodo at euismod nec, blandit ultrices
                            erat. Aliquam eros ipsum, interdum et mattis vitae, faucibus vitae
                            justo. Nulla condimentum hendrerit leo, in feugiat ipsum
                            condimentum ac. Maecenas sed blandit dolor.
                        </p>
                    </div>
                </div>
            </section>
            <!-- Section: Design Block -->
        </div>
        <!-- Container for demo purpose -->
        <!-- FAQ Section: Simple -->
        <div class=" dark:text-gray-100 dark:bg-gray-900">
            <div class="space-y-16 container xl:max-w-7xl mx-auto px-4 py-16 lg:px-8 lg:py-32">
                <!-- Heading -->
                <div class="text-center">
                    <div class="text-sm uppercase font-bold tracking-wider mb-1 text-blue-600 dark:text-blue-500">
                        We Answer
                    </div>
                    <h2 class="text-4xl font-black text-black dark:text-white">
                        Frequently Asked Questions
                    </h2>
                </div>
                <!-- END Heading -->

                <!-- FAQ -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                    <div>
                        <h4 class="font-semibold mb-2">
                            What features are included?
                        </h4>
                        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
                            Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed
                            consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">
                            Can I use PayPal to pay you?
                        </h4>
                        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
                            Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed
                            consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">
                            Do I get access to the community?
                        </h4>
                        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
                            Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed
                            consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">
                            Can I get a refund just in case?
                        </h4>
                        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
                            Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed
                            consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">
                            Do you offer email support?
                        </h4>
                        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
                            Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed
                            consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">
                            Are the updates free for life?
                        </h4>
                        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
                            Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed
                            consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
                        </p>
                    </div>
                </div>
                <!-- END FAQ -->

                <!-- Link -->
                <div class="text-center">
                    <a href="javascript:void(0)"
                        class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-4 py-2 leading-6 border-gray-200  text-gray-800 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:ring focus:ring-gray-300 focus:ring-opacity-25 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600 dark:focus:ring-opacity-40 dark:active:border-gray-700">
                        <svg class="hi-mini hi-arrow-top-right-on-square inline-block w-5 h-5 opacity-50"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M4.25 5.5a.75.75 0 00-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 00.75-.75v-4a.75.75 0 011.5 0v4A2.25 2.25 0 0112.75 17h-8.5A2.25 2.25 0 012 14.75v-8.5A2.25 2.25 0 014.25 4h5a.75.75 0 010 1.5h-5z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M6.194 12.753a.75.75 0 001.06.053L16.5 4.44v2.81a.75.75 0 001.5 0v-4.5a.75.75 0 00-.75-.75h-4.5a.75.75 0 000 1.5h2.553l-9.056 8.194a.75.75 0 00-.053 1.06z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Go to support center</span>
                    </a>
                </div>
                <!-- END Link -->
            </div>
        </div>
        <Footer />

    </section>
</template>
