<script setup>
import Logout from "@/Modals/triggers/Logout.vue";
import Navbar from "@/Components/Navbar.vue";
import { Avatar } from 'flowbite-vue'

</script>

<template>
    <Navbar :dark="true" :snipperColor="`#445da2`" />

    <main class="profile-page ">
        <section class="relative min-h-screen bg-white">
            <div class="container mx-auto py-16">

                <div class="text-center my-8">
                    <slot />
                </div>
            </div>


        </section>
    </main>
</template>
