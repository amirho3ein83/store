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
});

let picked_color = ref([]);

const addColor = (color) => {

};

const form = useForm({
    title: "",
    description: "",
    price: "",
    sale_price: "",
    stock: null,
    category_id: null,
    image: null,
});

const addproduct = () => {
    form.post(route("product.store"), {
        onSuccess: () => {
            alert("product added successfully");
            form.reset();
            previewImage.value = null
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
    layout: AdminLayout
}
</script>
<template>

    <Head title="Create Product" />

    <section class="bg-gray-200 min-h-screen">
        <div class="mx-auto max-w-screen-xl px-4 py-5 sm:px-6 lg:px-8">
            <div class="flex justify-around ">


                <!-- preview card -->
                <div class="flex  px-1 flex-col justify-center items-center w-1/3 my-2">

                    <img v-if="previewImage == null" alt="Headphones" src="../pics/image-prev.png"
                        class="h-[300px] w-full shadow-lg spacity-20 object-cover sm:h-[350px]" />

                    <img v-else :src="imageUrl" alt=""
                        class="h-[300px] w-full shadow-lg spacity-20 object-cover sm:h-[350px]" />
                    <div class=" bg-gray-100 w-full shadow-lg rounded-sm overflow-hidden">
                        <div class="flex px-2 justify-between items-center ">
                            <div class="py-2 text-center font-bold uppercase tracking-wide text-gray-800">
                                {{ form.title }}
                            </div>
                            <div class="flex gap-2">
                                <p class="ml-2 text-sm font-bold text-yellow-700 dark:text-white">
                                    5<i class="bi bi-star-fill text-yellow-500"></i>
                                </p>
                                <p
                                    class="text-sm font-medium text-slate-900 underline hover:no-underline dark:text-white">
                                    12000 reviews</p>
                            </div>
                        </div>

                        <span class="truncate text-xs h-24 text-slate-600 mx-2">
                            {{ form.description }}
                        </span>
                        <div class="flex items-center justify-between py-2 px-3 bg-gray-400">
                            <h1 class="text-gray-800 font-bold">
                                $<span class="text-yellow-800"> {{ form.sale_price }}</span>
                            </h1>

                        </div>
                    </div>
                </div>

                <!-- form -->
                <div class="rounded-lg bg-gray-500 p-4 shadow-lg lg:col-span-3 lg:p-4 ">
                    <form @submit.prevent="addproduct" class="space-y-4" enctype="multipart/form-data">
                        <div>
                            <InputLabel for="image" value="image" />
                            <TextInput id="image" type="file" ref="fileInput" @change="pickFile"
                                class="mt-1 block w-full" required />
                            <InputError class="mt-2" :message="form.errors.image" />
                        </div>
                        <div class="w-1/3 py-3 px-4 rounded-lg bg-gray-400 text-gray-500 font-semibold cursor-pointer">
<!-- 
                            <Dropdown align="left" width="52">
                                <template #trigger>
                                    <span class="text-gray-50 " v-if="f
                                    rm.category_id == null"> categorie</span>
                                    <span class="text-gray-50 " v-else> {{ categories[form.category_id].name }}</span>
                                    <i class="text-gray-50 bi bi-chevron-down px-2"></i>
                                </template>

                                <template #content>
                                    <div v-for="category of categories">
                                        <input type="radio" v-model="form.category_id" name="option" :id="category.id"
                                            :value="category.id" class="peer hidden" />
                                        <label :for="category.id"
                                            class="block cursor-pointer text-gray-50 hover:bg-gray-600 select-none rounded-xl p-2 text-center peer-checked:bg-gray-500 peer-checked:font-bold peer-checked:text-white">{{
                                                category.name
                                            }}</label>
                                    </div>
                                </template>
                            </Dropdown> -->
                        </div>
                        <div>
                            <InputLabel for="title" value="title" />
                            <TextInput id="title" v-model="form.title" type="text" placeholder="title"
                                class="mt-1 block w-full" required />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>
                        <div class="flex justify-between gap-x-2">
                            <div>
                                <InputLabel for="price" value="price" />
                                <TextInput id="price" v-model="form.price" type="number" placeholder="price"
                                    class="mt-1 block w-full" required />
                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>
                            <div>
                                <InputLabel for="sale_price" value="sale_price" />
                                <TextInput id="sale_price" v-model="form.sale_price" type="number"
                                    placeholder="sale_price" class="mt-1 block w-full" required />
                                <InputError class="mt-2" :message="form.errors.sale_price" />
                            </div>
                        </div>

                        <!-- ///////////// -->

                        <div class="flex  text-sm text-gray-600 items-center">
                            <div class="flex-1 inbuttonne-flex items-center mb-3">
                                <div class="w-full flex-none text-sm flex items-center text-gray-600 justify-center">
                                    <ul class="flex flex-row justify-center items-center space-x-2">


                                        <!-- gotta loop here for available colors -->


                                        <button @click="
                                                addColor(
                                                `blue`
                                                )
                                        ">
                                            <span :class="{
                                                'border-blue-500':
                                                    picked_color ==
                                                    `blue`,
                                            }"
                                                class="block p-1 border-2 border-gray-900 hover:border-blue-600 rounded-full transition ease-in duration-300">
                                                <a class="block w-3 h-3 bg-blue-600 rounded-full"></a>
                                            </span>
                                        </button>
                                        <button @click="
                                            addColor(
                                                `yellow`
                                            )
                                        ">
                                            <span :class="{
                                                'border-yellow-500':
                                                    picked_color ==
                                                    `yellow`,
                                            }"
                                                class="block p-1 border-2 border-gray-900 hover:border-yellow-600 rounded-full transition ease-in duration-300">
                                                <a class="block w-3 h-3 bg-yellow-600 rounded-full"></a>
                                            </span>
                                        </button>
                                        <button @click="
                                            addColor(
                                                `red`
                                            )
                                        ">
                                            <span :class="{
                                                'border-red-500':
                                                    picked_color ==
                                                    `red`,
                                            }"
                                                class="block p-1 border-2 border-gray-900 hover:border-red-600 rounded-full transition ease-in duration-300">
                                                <a class="block w-3 h-3 bg-red-600 rounded-full"></a>
                                            </span>
                                        </button>
                                        <button @click="
                                            addColor(
                                                `purple`
                                            )
                                        ">
                                            <span :class="{
                                                'border-purple-500':
                                                    picked_color ==
                                                    `purple`,
                                            }"
                                                class="block p-1 border-2 border-gray-900 hover:border-purple-600 rounded-full transition ease-in duration-300">
                                                <a class="block w-3 h-3 bg-purple-600 rounded-full"></a>
                                            </span>
                                        </button>
                                    </ul>
                                </div>
                            </div>
                            <div class="flex-1 inbuttonne-flex items-center mb-3">


                                <input type="checkbox" id="S" value="S" v-model="checked_sizes">
                                <label class="m-2" for="S">S</label>

                                <input type="checkbox" id="M" value="M" v-model="checked_sizes">
                                <label class="m-2" for="M">M</label>

                                <input type="checkbox" id="L" value="L" v-model="checked_sizes">
                                <label class="m-2" for="L">L</label>

                                <input type="checkbox" id="XL" value="XL" v-model="checked_sizes">
                                <label class="m-2" for="XL">XL</label>

                                <input type="checkbox" id="XXL" value="XXL" v-model="checked_sizes">
                                <label class="m-2" for="XXL">XXL</label>
                            </div>
                        </div>


                        <!-- ///////////// -->

                        <div>
                            <InputLabel for="stock" value="stock" />
                            <TextInput id="stock" v-model="form.stock" type="number" placeholder="stock"
                                class="mt-1 block w-full" required />
                            <InputError class="mt-2" :message="form.errors.stock" />
                        </div>
                        <div>
                            <InputLabel for="description" value="description" />
                            <textarea class="w-full rounded-lg border-gray-200 p-3 text-md" placeholder="Description"
                                rows="2" v-model="form.description" name="description"></textarea>
                        </div>


                        <div class="flex justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Add
                            </PrimaryButton>
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
