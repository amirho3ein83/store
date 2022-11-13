<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Navbar from "@/Components/Navbar.vue";

</script>

<template>

    <Head title="Store Page" />

    <!-- Container for demo purpose -->
    <div>

        <!-- Section: Design Block -->
        <section >
            <Navbar />
            <div class="relative overflow-hidden bg-no-repeat bg-cover" style="
      background-position: 50%;
      background-image: url('https://www.grandhotelgardone.it/images/slide/shopping/slides_shopping.jpg');
      height: 500px;
    ">
                <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed"
                    style="background-color: rgba(0, 0, 0, 0.75)">
                    <div class="flex justify-center items-center h-full">
                        <div class="text-center text-white px-6 md:px-12">
                            <h1 class="text-5xl md:text-6xl xl:text-7xl font-bold tracking-tight mb-12 text-cyan-400">
                                your best shopping experience <br /><span class="text-pink-600">starts here</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section: Design Block -->

    </div>
    <!-- Container for demo purpose -->
</template>
