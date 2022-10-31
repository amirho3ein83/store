<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

</script>

<template>
<AppLayout>

    <div>
        <h1 class="sr-only">Checkout</h1>

        <div class="relative mx-auto max-w-screen-2xl">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="bg-gray-50 py-12 md:py-24">
                    <div class="mx-auto max-w-lg px-4 lg:px-8">
                        <div class="flex items-center">
                            <span
                                class="h-10 w-10 rounded-full bg-blue-900"
                            ></span>

                            <h2 class="ml-4 font-medium">BambooYou</h2>
                        </div>

                        <div class="mt-8">
                            <p class="text-2xl font-medium tracking-tight">
                                $99.99
                            </p>
                            <p class="mt-1 text-sm text-gray-500">
                                For the purchase of
                            </p>
                        </div>

                        <div class="mt-12">
                            <div class="flow-root">
                                <ul class="-my-4 divide-y divide-gray-200">
                                    <li
                                        class="flex items-center justify-between py-4"
                                    >
                                        <div class="flex items-start">
                                            <img
                                                alt="Trainer"
                                                src="https://images.unsplash.com/photo-1565299999261-28ba859019bb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80"
                                                class="h-16 w-16 flex-shrink-0 rounded-lg object-cover"
                                            />

                                            <div class="ml-4">
                                                <p class="text-sm">
                                                    Vibrant Trainers
                                                </p>

                                                <dl
                                                    class="mt-1 space-y-1 text-xs text-gray-500"
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
                                            <p class="text-sm">
                                                $49.99
                                                <small class="text-gray-500"
                                                    >x1</small
                                                >
                                            </p>
                                        </div>
                                    </li>

                                    <li
                                        class="flex items-center justify-between py-4"
                                    >
                                        <div class="flex items-start">
                                            <img
                                                alt="Lettuce"
                                                src="https://images.unsplash.com/photo-1640958904159-51ae08bd3412?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1771&q=80"
                                                class="h-16 w-16 flex-shrink-0 rounded-lg object-cover"
                                            />

                                            <div class="ml-4">
                                                <p class="text-sm">Lettuce</p>

                                                <dl
                                                    class="mt-1 space-y-1 text-xs text-gray-500"
                                                >
                                                    <div>
                                                        <dt class="inline">
                                                            Size:
                                                        </dt>
                                                        <dd class="inline">
                                                            Big
                                                        </dd>
                                                    </div>
                                                </dl>
                                            </div>
                                        </div>

                                        <div>
                                            <p class="text-sm">
                                                $25
                                                <small class="text-gray-500"
                                                    >x2</small
                                                >
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white py-12 md:py-24">
                    <div class="mx-auto max-w-lg px-4 lg:px-8">
                        <form class="grid grid-cols-6 gap-4">
                            <div class="col-span-3">
                                <label
                                    class="mb-1 block text-sm text-gray-600"
                                    for="first_name"
                                >
                                    First Name
                                </label>

                                <input
                                    class="w-full rounded-lg border-gray-200 p-2.5 text-sm shadow-sm"
                                    type="text"
                                    id="first_name"
                                />
                            </div>

                            <div class="col-span-3">
                                <label
                                    class="mb-1 block text-sm text-gray-600"
                                    for="last_name"
                                >
                                    Last Name
                                </label>

                                <input
                                    class="w-full rounded-lg border-gray-200 p-2.5 text-sm shadow-sm"
                                    type="text"
                                    id="last_name"
                                />
                            </div>

                            <div class="col-span-6">
                                <label
                                    class="mb-1 block text-sm text-gray-600"
                                    for="email"
                                >
                                    Email
                                </label>

                                <input
                                    class="w-full rounded-lg border-gray-200 p-2.5 text-sm shadow-sm"
                                    type="email"
                                    id="email"
                                />
                            </div>

                            <div class="col-span-6">
                                <label
                                    class="mb-1 block text-sm text-gray-600"
                                    for="phone"
                                >
                                    Phone
                                </label>

                                <input
                                    class="w-full rounded-lg border-gray-200 p-2.5 text-sm shadow-sm"
                                    type="tel"
                                    id="phone"
                                />
                            </div>


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
