<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
    cart: Object,
});
</script>

<template>
    <AppLayout>
        <div class="bg-gray-200 h-screen overflow-y-hidden">
            <h1 class="sr-only">Checkout</h1>

            <div class="relative mx-auto max-w-screen-2xl">
                <div class="bg-gray-600 grid grid-cols-1 md:grid-cols-2">
                    <div class="bg-gray-200 pt-2 md:pt-4">
                        <div class="mx-auto max-w-lg px-4 lg:px-8">




                            <div class="mt-12">
                                <div class="flow-root">
                                    <ul class="-my-4 divide-y divide-gray-200">
                                        <!-- {{cart}} -->
                                        <li
                                            v-for="product of cart"
                                            class="flex bg-slate-700 rounded-lg px-3 items-center justify-between py-4"
                                        >
                                            <div class="flex items-start">
                                                <img
                                                    alt="Trainer"
                                                    src="https://images.unsplash.com/photo-1565299999261-28ba859019bb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80"
                                                    class="h-20 w-20 flex-shrink-0 rounded-lg object-cover"
                                                />
                                                <h1 class="text-gray-200 text-lg mx-2">
                                                    {{
                                                        product.products[0].name
                                                    }}
                                                </h1>
                                                <div class="ml-4">
                                                    <p class="text-sm text-gray-200">
                                                        {{ product.quantity }}
                                                    </p>

                                                    <dl
                                                        class="mt-1 space-y-1 text-xs text-gray-200"
                                                    >
                                                        <div>
                                                            <dt class="inline">
                                                                Color:
                                                            </dt>
                                                            <dd class="inline">
                                                                Blue
                                                            </dd>
                                                        </div>

                                                        <div>
                                                            <dt class="inline">
                                                                Size:
                                                            </dt>
                                                            <dd class="inline">
                                                                UK 10
                                                            </dd>
                                                        </div>
                                                    </dl>
                                                </div>
                                            </div>

                                            <div>
                                                <p class="text-sm text-gray-200">
                                                    {{ product.price }} $
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-200 pt-12 md:pt-24">
                        <div class="mx-auto max-w-lg px-4 lg:px-8">
                            <form >
                                <p class="text-2xl font-medium tracking-tight">
                                   total: $99.99
                                </p>


                                <div class="col-span-6">
                                    <button
                                        class="block w-full rounded-lg bg-black p-2.5 text-sm text-white"
                                        type="submit"
                                    >
                                        Pay Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
