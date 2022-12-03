<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { useProductStore } from "@/store/Product.js";
import { ref, watch } from "vue";
import { createToast } from "mosha-vue-toastify";

const storeProduct = useProductStore();

let props = defineProps({
    product_id: Number,
});

const form = useForm({
    body: "",
    suggestion: "suggestion-yes",
    product_id: props.product_id,
});

const submit = () => {
    form.post(route("submit.comment"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            // storeProduct.fetchComments(props.product_id);
            createToast(" نظر شما ثبت شد", {
                type: "success",
                hideProgressBar: "true",
                timeout: 2000,
                showIcon: "true",
            });
        },
    });
};
</script>

<template>
    <div
        class="bg-gray-200/75 dark:bg-gray-900 py-8 w-full px-4 sm:w-1/2 lg:py-12 text-right"
    >
        <h2
            class="text-lg lg:text-xl p-4 font-semibold text-stone-800 dark:text-white"
        >
            نظرت رو درباره این محصول بنویس
        </h2>
        <form @submit.prevent="submit" class="mb-6">
            <div
                class="py-2 text-right px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700"
            >
                <label for="comment" class="sr-only">Your comment</label>
                <textarea
                    id="comment"
                    rows="6"
                    v-model="form.body"
                    class="px-0 w-full text-sm text-gray-800 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                    placeholder="...کامنت"
                    required
                ></textarea>
            </div>

            <div class="flex justify-between items-center space-x-2">
                <div>
                    <fieldset class="space-y-4 flex items-center">
                        <div>
                            <input
                                type="radio"
                                name="DeliveryOption"
                                value="yes"
                                v-model="form.suggestion"
                                id="suggestion-yes"
                                class="peer hidden"
                                checked
                            />

                            <label
                                for="suggestion-yes"
                                class="cursor-pointer text-sm text-slate-400 hover:text-green-500 peer-checked:text-green-500"
                            >
                                <i
                                    class="bi cursor-pointer bi-hand-thumbs-up-fill px-2"
                                ></i>
                            </label>
                        </div>

                        <div>
                            <input
                                type="radio"
                                name="DeliveryOption"
                                value="no"
                                v-model="form.suggestion"
                                id="suggestion-no"
                                class="peer hidden"
                            />

                            <label
                                for="suggestion-no"
                                class="cursor-pointer text-sm text-slate-400 hover:text-red-500 peer-checked:text-red-500"
                            >
                                <i
                                    class="bi cursor-pointer bi-hand-thumbs-down-fill px-2"
                                ></i>
                            </label>
                        </div>
                    </fieldset>
                </div>
                <button
                    type="submit"
                    class="inline-flex items-center py-2.5 px-4 text-md font-medium text-center text-gray-900 bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:text-blue-500"
                >
                    ثبت نظر
                </button>
            </div>
        </form>
    </div>
</template>
