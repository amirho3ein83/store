<script setup>
import { Head, Link, usePage } from "@inertiajs/inertia-vue3";
import Hero2 from "@/Components/Hero2.vue";
import AmazingOffer from "@/Components/AmazingOffer.vue";
import "vue-horizontal-scroll/dist/vue-horizontal-scroll.css";
import CategoryItem from "@/Components/CategoryItem.vue";
import { OrbitSpinner } from "epic-spinners";
import { useCartStore } from "@/store/Cart.js";
import { computed, onMounted } from "vue";

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
                background-image: url('https://www.jowhareh.com/images/Jowhareh/galleries/poster_045f5b65-f4ae-4b05-8916-1740a7c5e967.png');
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
                        <p class="text-md font-semibold leading-6 text-gray-200">Home</p>
                        </Link>
                        <Link :href="route(`category.list`)" preserve-scroll>
                        <p class="text-md font-semibold leading-6 text-gray-200">Categories</p>
                        </Link>
                        <Link href="/contact-us" preserve-scroll>
                        <p class="text-md font-semibold leading-6 text-gray-200">Contact us</p>
                        </Link>

                    </div>

                    <div v-if="$page.props.auth" class="hidden lg:flex lg:flex-1 lg:justify-end">


                        <Link :href="route('user.profile')" class="text-gray-100 px-3 duration-100 hover:opacity-80">

                        <div class="flex items-center space-x-4">
                            <img class="w-10 h-10 rounded-full"
                                src="https://img.freepik.com/premium-vector/man-avatar-profile-picture-vector-illustration_268834-538.jpg"
                                alt="profile">
                            <div class="font-medium dark:text-white">
                                <p class="text-slate-50">{{ $page.props.user.name }}</p>
                            </div>
                        </div>
                        </Link>
                    </div>

                    <div v-else class="hidden lg:flex lg:flex-1 lg:justify-end">
                        <Link href="/login" class="text-gray-100 px-3 duration-100 hover:scale-110">

                        <p class="text-md font-semibold leading-6 text-gray-200">sign in</p>
                        </Link>
                        <Link href="/register" class="text-gray-100 px-3 duration-100 hover:scale-110">

                        <p class="text-md font-semibold leading-6 text-gray-200">sign up</p>
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

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-12 mx-auto">
                <div class="flex flex-wrap -m-4">
                    <CategoryItem v-for="category of categories" :key="category.id" :category="category"
                        :path="`subCategories.list`" />
                </div>
            </div>
        </section>

        <div class="relative overflow-hidden">
            <div class="pt-16 pb-80 sm:pt-24 sm:pb-40 lg:pt-40 lg:pb-48">
                <div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8">
                    <div class="sm:max-w-lg">
                        <h1 class="font text-4xl font-bold tracking-tight text-gray-200 sm:text-6xl">
                            سبک های تابستانی بالاخره آمدند
                        </h1>
                        <p class="mt-4 text-xl text-gray-500">
                            امسال، مجموعه تابستانی جدید ما شما را در برابر عناصر
                            خشن دنیایی که برای زنده ماندن یا مردن شما اهمیتی
                            ندارد، پناه خواهد داد.
                        </p>
                    </div>
                    <div>
                        <div class="mt-10">
                            <!-- Decorative image grid -->
                            <div aria-hidden="true"
                                class="pointer-events-none lg:absolute lg:inset-y-0 lg:mx-auto lg:w-full lg:max-w-7xl">
                                <div
                                    class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8">
                                    <div class="flex items-center space-x-6 lg:space-x-8">
                                        <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                            <div class="h-64 w-44 overflow-hidden rounded-lg sm:opacity-0 lg:opacity-100">
                                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-01.jpg"
                                                    alt="" class="h-full w-full object-cover object-center" />
                                            </div>
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-02.jpg"
                                                    alt="" class="h-full w-full object-cover object-center" />
                                            </div>
                                        </div>
                                        <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-03.jpg"
                                                    alt="" class="h-full w-full object-cover object-center" />
                                            </div>
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-04.jpg"
                                                    alt="" class="h-full w-full object-cover object-center" />
                                            </div>
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-05.jpg"
                                                    alt="" class="h-full w-full object-cover object-center" />
                                            </div>
                                        </div>
                                        <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-06.jpg"
                                                    alt="" class="h-full w-full object-cover object-center" />
                                            </div>
                                            <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-07.jpg"
                                                    alt="" class="h-full w-full object-cover object-center" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="#"
                                class="inline-block rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-center font-medium text-white hover:bg-indigo-700">مجموعه
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Features Section: Boxes with Icons -->
<div class="bg-gradient-to-tr from-indigo-100 via-purple-50 to-teal-100 dark:text-gray-100 dark:from-indigo-900 dark:via-purple-900 dark:to-teal-900">
  <div class="container xl:max-w-7xl mx-auto px-4 py-16 lg:px-8 lg:py-32">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
      <div class="p-5 md:p-7 xl:p-10 bg-white border border-white shadow-sm rounded-lg transition hover:border-blue-600 dark:bg-gray-800 dark:border-gray-800 dark:hover:border-blue-400 dark:shadow-none">
        <svg class="hi-outline hi-rectangle-stack inline-block w-12 h-12 text-blue-600 mb-5 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122"/></svg>
        <h4 class="text-lg font-bold mb-2">
          1. UI Components Library
        </h4>
        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
          We carefully handcrafted a vast collection of UI components to build all kinds of web applications and websites. We keep designing and adding new ones with each update.
        </p>
      </div>
      <div class="p-5 md:p-7 xl:p-10 bg-white border border-white shadow-sm rounded-lg transition hover:border-blue-600 dark:bg-gray-800 dark:border-gray-800 dark:hover:border-blue-400 dark:shadow-none">
        <svg class="hi-outline hi-cube inline-block w-12 h-12 text-blue-600 mb-5 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/></svg>
        <h4 class="text-lg font-bold mb-2">
          2. Self-Hosted Web App
        </h4>
        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
          You’ll love working with the Tailkit web app! It’s a compiled Vue.js based app which you can host on your own and use to explore and use all available UI components.
        </p>
      </div>
      <div class="p-5 md:p-7 xl:p-10 bg-white border border-white shadow-sm rounded-lg transition hover:border-blue-600 sm:col-span-2 lg:col-span-1 dark:bg-gray-800 dark:border-gray-800 dark:hover:border-blue-400 dark:shadow-none">
        <svg class="hi-outline hi-cog inline-block w-12 h-12 text-blue-600 mb-5 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495"/></svg>
        <h4 class="text-lg font-bold mb-2">
          3. Helper Tools
        </h4>
        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
          Search and copy SVG icons, build your button markup or copy your favorite color classes with powerful tools. More are under development to give you superpowers.
        </p>
      </div>
    </div>
  </div>
</div>
<!-- END Features Section: Boxes with Icons -->

        <section class="bg-white dark:bg-gray-900">
            <div
                class="container flex flex-col px-6 py-4 mx-auto space-y-6 lg:h-[32rem] lg:py-16 lg:flex-row lg:items-center">
                <div class="flex flex-col items-center w-full lg:flex-row lg:w-1/2">
                    <div class="flex justify-center order-2 mt-6 lg:mt-0 lg:space-y-3 lg:flex-col">
                        <button class="w-3 h-3 mx-2 bg-blue-500 rounded-full lg:mx-0 focus:outline-none"></button>
                        <button
                            class="w-3 h-3 mx-2 bg-gray-300 rounded-full lg:mx-0 focus:outline-none hover:bg-blue-500"></button>
                        <button
                            class="w-3 h-3 mx-2 bg-gray-300 rounded-full lg:mx-0 focus:outline-none hover:bg-blue-500"></button>
                        <button
                            class="w-3 h-3 mx-2 bg-gray-300 rounded-full lg:mx-0 focus:outline-none hover:bg-blue-500"></button>
                    </div>

                    <div class="max-w-lg lg:mx-12 lg:order-2">
                        <h1 class="text-3xl font-medium tracking-wide text-gray-800 dark:text-white lg:text-4xl">
                            The best Apple Watch apps
                        </h1>
                        <p class="mt-4 text-gray-600 dark:text-gray-300">
                            Lorem ipsum, dolor sit amet consectetur adipisicing
                            elit. Aut quia asperiores alias vero magnam
                            recusandae adipisci ad vitae laudantium quod rem
                            voluptatem eos accusantium cumque.
                        </p>
                        <div class="mt-6">
                            <a href="#"
                                class="block px-3 py-2 font-semibold text-center text-white transition-colors duration-300 transform bg-blue-500 rounded-md lg:inline hover:bg-blue-400">Download
                                from App Store</a>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center w-full h-96 lg:w-1/2">
                    <img class="object-cover w-full h-full max-w-2xl rounded-md"
                        src="https://images.unsplash.com/photo-1579586337278-3befd40fd17a?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1352&q=80"
                        alt="apple watch photo" />
                </div>
            </div>
        </section>

<!-- FAQ Section: Simple -->
<div class="bg-white dark:text-gray-100 dark:bg-gray-900">
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
          Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
        </p>
      </div>
      <div>
        <h4 class="font-semibold mb-2">
          Can I use PayPal to pay you?
        </h4>
        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
          Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
        </p>
      </div>
      <div>
        <h4 class="font-semibold mb-2">
          Do I get access to the community?
        </h4>
        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
          Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
        </p>
      </div>
      <div>
        <h4 class="font-semibold mb-2">
          Can I get a refund just in case?
        </h4>
        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
          Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
        </p>
      </div>
      <div>
        <h4 class="font-semibold mb-2">
          Do you offer email support?
        </h4>
        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
          Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
        </p>
      </div>
      <div>
        <h4 class="font-semibold mb-2">
          Are the updates free for life?
        </h4>
        <p class="leading-relaxed text-gray-600 dark:text-gray-400">
          Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque.
        </p>
      </div>
    </div>
    <!-- END FAQ -->

    <!-- Link -->
    <div class="text-center">
      <a href="javascript:void(0)" class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-4 py-2 leading-6 border-gray-200 bg-white text-gray-800 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:ring focus:ring-gray-300 focus:ring-opacity-25 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600 dark:focus:ring-opacity-40 dark:active:border-gray-700">
        <svg class="hi-mini hi-arrow-top-right-on-square inline-block w-5 h-5 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M4.25 5.5a.75.75 0 00-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 00.75-.75v-4a.75.75 0 011.5 0v4A2.25 2.25 0 0112.75 17h-8.5A2.25 2.25 0 012 14.75v-8.5A2.25 2.25 0 014.25 4h5a.75.75 0 010 1.5h-5z" clip-rule="evenodd"/><path fill-rule="evenodd" d="M6.194 12.753a.75.75 0 001.06.053L16.5 4.44v2.81a.75.75 0 001.5 0v-4.5a.75.75 0 00-.75-.75h-4.5a.75.75 0 000 1.5h2.553l-9.056 8.194a.75.75 0 00-.053 1.06z" clip-rule="evenodd"/></svg>
        <span>Go to support center</span>
      </a>
    </div>
    <!-- END Link -->
  </div>
</div>
<!-- END FAQ Section: Simple -->

        <section class="relative w-5/6 mx-auto overflow-hidden rounded-lg p-10 my-7 80 shadow-2xl lg:pb-0">
            <div class="ml-auto p-8 text-center sm:p-12 lg:w-2/3">
                <p class="text-sm font-semibold uppercase tracking-widest">
                    Run with the pack
                </p>

                <h2 class="mt-6 font-black uppercase">
                    <span class="text-5xl font-black sm:text-6xl">Get 20% off</span>
                    <span class="mt-2 block text-sm">On your next order over $50</span>
                </h2>

                <a class="mt-8 inline-block w-full bg-black py-4 text-sm font-bold uppercase tracking-widest text-white"
                    href="">
                    Get Discount
                </a>

                <p class="mt-12 text-xs font-medium uppercase text-gray-400">
                    Offer valid until 24th March, 2021 *
                </p>
            </div>

            <div class="absolute bottom-0 left-0 h-80 w-full lg:h-full lg:w-1/3">
                <img alt="Trainer" src="https://i.pinimg.com/550x/e0/6d/bf/e06dbfa4febaea3a3735eba741626771.jpg"
                    class="absolute inset-0 h-full w-full object-cover" />
            </div>
        </section>
    </section></template>
