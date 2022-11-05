<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import WalletCard from "@/Components/WalletCard.vue";

let props = defineProps({
    user:Object
})
</script>

<template>
    <Transition>
        <AppLayout class="bg-gray-700">
            <!-- component -->
                <!-- Container -->
                <div class="container mx-auto">
                    <div class="flex justify-center px-6 mt-12">
                        <!-- Row -->
                        <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                            <!-- Col -->
                            <div>
                                <img
                                    v-if="previewImage == null"
                                    alt="Headphones"
                                    src="https://thumbs.dreamstime.com/b/handsome-man-black-suit-white-shirt-posing-studio-attractive-guy-fashion-hairstyle-confident-man-short-beard-125019349.jpg"
                                    class="h-[300px] w-full spacity-20 object-cover sm:h-[350px]"
                                />
                                <img
                                    v-else
                                    alt="Headphones"
                                    :src="imageUrl"
                                    class="h-[300px] w-full object-cover sm:h-[350px]"
                                />
                            </div>
                            <!-- Col -->
                            <div
                                class="w-full flex-1 lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none"
                            >
                                <h3 class="pt-4 text-2xl text-center">
                                    {{props.user.name}}
                                </h3>
                                <form
                                    class="px-8 pt-6 pb-8 mb-4 bg-white rounded"
                                >
                                    <div
                                        class="mb-4 md:flex md:justify-between"
                                    >
                                        <div class="mb-4 md:mr-2 md:mb-0">
                                            <label
                                                class="block mb-2 text-sm font-bold text-gray-700"
                                                for="Name"
                                            >
                                                Name
                                            </label>
                                            <input
                                                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                                id="Name"
                                                type="text"
                                                placeholder=" Name"
                                                :value=" props.user.name"
                                            />
                                        </div>
                                        <div class="md:ml-2">
                                            <label
                                                class="block mb-2 text-sm font-bold text-gray-700"
                                                for="mobile"
                                            >
                                                Mobile
                                            </label>
                                            <input
                                                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                                id="mobile"
                                                type="text"
                                                :value=" props.user.mobile"
                                                placeholder="Mobile"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label
                                            class="block mb-2 text-sm font-bold text-gray-700"
                                            for="address"
                                        >
                                            address
                                        </label>
                                        <input
                                            class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                            id="address"
                                            type="text"
                                            :value=" props.user.address"
                                            placeholder="address"
                                        />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>

<WalletCard/>
        </AppLayout>
    </Transition>
</template>
