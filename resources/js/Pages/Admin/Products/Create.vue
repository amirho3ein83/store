<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, watch } from "vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Dropdown from "@/Components/Dropdown.vue";

const previewImage = ref(null);
const imageUrl = ref(null);

let props = defineProps({
    categories: Object,
    colors: Object,
    sizes: Object,
    brands: Object,
});

let picked_color = ref([]);

const addColor = (color) => {};

const form = useForm({
    title: "",
    description: "",
    details: "",
    default_price: "",
    stock: null,
    category_id: null,
    image: null,
});

const addproduct = () => {
    form.post(route("product.store"), {
        onSuccess: () => {
            alert("product added successfully");
            form.reset();
            previewImage.value = null;
        },
        onError: (error) => {
            alert("failed:" + error);
            form.reset();
        },
    });
};

const pickFile = (event) => {
    console.log(event);
    if (event.target.files.length == 0) {
        return;
    }
    previewImage.value = event.target.files[0];
    form.image = event.target.files[0];
};

watch(previewImage, (previewImage) => {
    let reader = new FileReader();

    reader.readAsDataURL(previewImage);

    reader.addEventListener("load", () => {
        imageUrl.value = reader.result;
    });
});
</script>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    layout: AdminLayout,
};
</script>
<template>
    <Head title="Create Product" />

    <section class="bg-gray-200 min-h-screen">
        <div class="mx-auto max-w-screen-xl px-4 py-5 sm:px-6 lg:px-8">
            <div class="flex justify-around">
                <!-- preview card -->
                <div
                    class="flex px-1 flex-col justify-center items-center w-1/3 my-2"
                >
                    <img
                        v-if="previewImage == null"
                        alt="Headphones"
                        src="../pics/image-prev.png"
                        class="h-[300px] w-full shadow-lg spacity-20 object-cover sm:h-[350px]"
                    />

                    <img
                        v-else
                        :src="imageUrl"
                        alt=""
                        class="h-[300px] w-full shadow-lg spacity-20 object-cover sm:h-[350px]"
                    />
                    <div
                        class="bg-gray-100 w-full shadow-lg rounded-sm overflow-hidden"
                    >
                        <div class="flex px-2 justify-between items-center">
                            <div
                                class="py-2 text-center font-bold uppercase tracking-wide text-gray-800"
                            >
                                {{ form.title }}
                            </div>
                            <div class="flex gap-2">
                                <p
                                    class="ml-2 text-sm font-bold text-yellow-700 dark:text-white"
                                >
                                    5<i
                                        class="bi bi-star-fill text-yellow-500"
                                    ></i>
                                </p>
                                <p
                                    class="text-sm font-medium text-slate-900 underline hover:no-underline dark:text-white"
                                >
                                    12000 reviews
                                </p>
                            </div>
                        </div>

                        <span class="truncate text-xs h-24 text-slate-600 mx-2">
                            {{ form.details }}
                        </span>
                        <div
                            class="flex items-center justify-between py-2 px-3 bg-gray-400"
                        >
                            <h1 class="text-gray-800 font-bold">
                                $<span class="text-yellow-800">
                                    {{ form.default_price }}</span
                                >
                            </h1>
                        </div>
                    </div>
                </div>

                <!-- form -->

                <div
                    class="bg-stone-200 shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col w-1/2 my-6 mx-auto"
                >
                    <form
                        @submit.prevent="addproduct"
                        class="space-y-4"
                        enctype="multipart/form-data"
                    >
                        <div class="-mx-3 md:flex mb-2 justify-between">
                            <div class="flex flex-col">
                                <div class="md:w-full px-3 mb-2 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                        for="title"
                                    >
                                        title
                                    </label>
                                    <input
                                        v-model="form.title"
                                        class="block w-full bg-grey-lighter text-grey-darker border border-red rounded py-2 px-4 mb-3"
                                        id="title"
                                        type="text"
                                    />
                                </div>
                                <div class="md:w-full px-3 mb-2 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                        for="default_price"
                                    >
                                        default_price
                                    </label>
                                    <input
                                        v-model="form.default_price"
                                        class="block w-full bg-grey-lighter text-grey-darker border border-red rounded py-2 px-4 mb-3"
                                        id="default_price"
                                        type="number"
                                    />
                                </div>
                                <div
                                    class="flex py-2 px-4 rounded-lg text-gray-500 font-semibold cursor-pointer"
                                >
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span>brand</span>
                                            <i
                                                class="bi bi-chevron-down px-2"
                                            ></i>
                                        </template>

                                        <template #content>
                                            <div
                                                v-for="brand of brands"
                                                :key="brand.id"
                                            >
                                                <input
                                                    type="radio"
                                                    v-model="form.brand_id"
                                                    name="option"
                                                    :id="brand.id"
                                                    :value="brand.id"
                                                    class="peer hidden"
                                                />
                                                <label
                                                    :for="brand.id"
                                                    class="block cursor-pointer text-gray-50 hover:bg-gray-600 select-none p-2 text-center peer-checked:bg-gray-500 peer-checked:font-bold peer-checked:text-white"
                                                    >{{ brand.name }}</label
                                                >
                                            </div>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>

                            <div class="relative">
                                <div
                                    class="block appearance-none h-48 overflow-auto w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-2 px-4 pr-8 rounded"
                                >
                                    <div
                                        class="flex justify-between"
                                        v-for="category of categories"
                                        :key="category.id"
                                    >
                                        {{ category.name }}
                                        <input
                                            type="checkbox"
                                            :value="category.id"
                                            v-model="pickedCategories"
                                            name=""
                                            id=""
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-2">
                            <div class="md:w-full px-3">
                                <label
                                    class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                >
                                    details
                                </label>
                                <input
                                    v-model="form.details"
                                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-3"
                                />
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-2">
                            <div class="md:w-full px-3">
                                <label
                                    class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                >
                                    description
                                </label>
                                <input
                                    v-model="form.description"
                                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-3"
                                />
                            </div>
                        </div>

                        <div>
                            <InputLabel for="image" value="image" />
                            <TextInput
                                id="image"
                                type="file"
                                ref="fileInput"
                                @change="pickFile"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.image"
                            />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
<!-- <style>
.imagePreviewWrapper {
    background-repeat: no-repeat;
    width: 250px;
    height: 250px;
    display: block;
    cursor: pointer;
    margin: 0 auto 30px;
    background-size: contain;
    background-position: center center;
}
</style> -->
