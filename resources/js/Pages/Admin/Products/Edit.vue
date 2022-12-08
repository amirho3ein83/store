<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { computed, reactive, ref, toRef, watch } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Dropdown from "@/Components/Dropdown.vue";
import { createToast } from "mosha-vue-toastify";
import JetInputError from "@/Components/InputError.vue";


const defaultImage = ref(props.product.image_url);
const newImage = ref(null);

let props = defineProps({
    product: Object,
    categories: Object,
    colors: Object,
});

const productCategoryIds = computed(() => {
    let categoryIds = [];
    categoryIds.push(...props.product.categories.map((emp) => emp.id));
    return categoryIds;
});

const state = reactive({
    productColors: props.product.available_colors,
    productAttributes: props.product.attributes,
});

const addPriceGroup = () => {
    state.productColors.push({
        id: "",
        fa_name: " ",
        en_name: "",
        pivot: { product_id: "", color_id: "", price: "", stock: "" },
    });
};

const removePriceGroup = (index) => {
    state.productColors.splice(index, 1);
};

const addProductAttribute = () => {
    state.productAttributes.push({
        title: "",
        value: "",
    });
};

const removeProductAttribute = (index) => {
    state.productAttributes.splice(index, 1);
};

const chooseColor = (index, color) => {
    state.productColors[index].id = color.id;
    state.productColors[index].en_name = color.en_name;
    state.productColors[index].fa_name = color.fa_name;
    state.productColors[index].pivot.color_id = color.id;
};

const form = useForm({
    title: props.product.title,
    description: props.product.description,
    details: props.product.details,
    picked_categories: productCategoryIds,
    colors: state.productColors,
    product_attributes: state.productAttributes,
    image: null,
});

const addproduct = () => {
    form.post(route("admin.product.update", { id: props.product.id }), {
        onSuccess: (res) => {
            createToast("تغییرات اعمال شد", {
                type: "success",
                hideProgressBar: "true",
                timeout: 2000,
                showIcon: "true",
            });
        },
        onError: (error) => {
            // showError(error);
        },
    });
};

const showError = (error) => {
    createToast(error, {
        position: "bottom-right",
        transition: "zoom",
        type: "danger",
        toastBackgroundColor: "#fc4242",
        timeout: 2900,
    });
    form.errors == null;
};

const pickFile = (event) => {
    console.log(event);
    if (event.target.files.length == 0) {
        return;
    }
    defaultImage.value = event.target.files[0];
    form.image = event.target.files[0];
};

watch(defaultImage, (defaultImage) => {
    let reader = new FileReader();

    reader.readAsDataURL(defaultImage);

    reader.addEventListener("load", () => {
        newImage.value = reader.result;
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

    <div class="min-h-screen p-6 bg-gray-100 flex justify-center">
        <div class="container max-w-screen-xl mx-auto">
            <div>
                <div
                    class="bg-[#d9dadb] rounded shadow-lg p-4 px-4 md:p-8 mb-6"
                >
                    <div class="flex gap-x-12">
                        <!-- preview card -->
                        <div class="text-gray-600 w-1/3">
                            <div
                                class="flex px-1 flex-col justify-center items-center my-2"
                            >
                                <img
                                    v-if="!newImage"
                                    :src="defaultImage"
                                    alt=""
                                    class="h-[300px] w-full shadow-lg spacity-20 object-cover sm:h-[350px]"
                                />
                                <img
                                    v-else
                                    :src="newImage"
                                    alt=""
                                    class="h-[300px] w-full shadow-lg spacity-20 object-cover sm:h-[350px]"
                                />

                                <div
                                    class="bg-gray-100 w-full shadow-lg rounded-sm overflow-hidden"
                                >
                                    <div
                                        class="flex px-2 justify-between items-center"
                                    >
                                        <div
                                            class="py-2 text-center font-bold text-gray-800"
                                        >
                                            {{ form.title }}
                                        </div>
                                        <div class="flex gap-2">
                                            <p
                                                class="ml-2 text-sm font-bold text-yellow-700 dark:text-white"
                                            >
                                                {{ product.rate
                                                }}<i
                                                    class="bi bi-star-fill text-yellow-500"
                                                ></i>
                                            </p>
                                            <p
                                                class="text-sm font-medium text-slate-900 underline hover:no-underline dark:text-white"
                                            >
                                                {{ product.reviews }} بازدید
                                            </p>
                                        </div>
                                    </div>

                                    <span
                                        class="truncate text-sm h-24 text-slate-600 mx-2"
                                    >
                                        {{ form.details }}
                                    </span>

                                </div>
                            </div>
                        </div>
                        <!-- main form -->
                        <div class="lg:col-span-2 flex-1">
                            <form
                                @submit.prevent="addproduct"
                                class="space-y-4"
                                enctype="multipart/form-data"
                            >
                                <div class="-mx-3 md:flex mb-2 justify-between">
                                    <div class="flex flex-col">
                                        <div
                                            class="md:w-full px-3 mb-2 md:mb-0"
                                        >
                                            <label
                                                class="block text-grey-darker text-sm font-bold mb-2"
                                                for="title"
                                            >
                                                عنوان
                                            </label>
                                            <input
                                                v-model="form.title"
                                                class="block w-full bg-grey-lighter text-grey-darker border border-red rounded py-2 px-4 mb-3"
                                                id="title"
                                                type="text"
                                            />
                                            <JetInputError
                                                class="mt-2"
                                                :message="form.errors.title"
                                            />
                                        </div>

                                        <div>
                                            عکس
                                            <TextInput
                                                id="image"
                                                type="file"
                                                ref="fileInput"
                                                @change="pickFile"
                                                class="mt-1 block w-[100px]"
                                            />
                                            <JetInputError
                                                class="mt-2"
                                                :message="form.errors.image"
                                            />
                                        </div>
                                    </div>

                                    <div class="relative">
                                        دسته بندی
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
                                                    v-model="
                                                        form.picked_categories
                                                    "
                                                    name=""
                                                    id=""
                                                />
                                            </div>
                                        </div>
                                        <JetInputError
                                            class="mt-2"
                                            :message="form.errors.categories"
                                        />
                                    </div>
                                </div>

                                <div class="flex">
                                    <div class="md:w-full px-3">
                                        <label
                                            class="block text-grey-darker text-sm font-bold mb-2"
                                        >
                                            جزییات
                                        </label>
                                        <input
                                            v-model="form.details"
                                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-3"
                                        />
                                        <JetInputError
                                            class="mt-2"
                                            :message="form.errors.details"
                                        />
                                    </div>
                                    <div class="md:w-full px-3">
                                        <label
                                            class="block text-grey-darker text-sm font-bold mb-2"
                                        >
                                            توضیحات
                                        </label>
                                        <input
                                            v-model="form.description"
                                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-3"
                                        />
                                        <JetInputError
                                            class="mt-2"
                                            :message="form.errors.description"
                                        />
                                    </div>
                                </div>

                                <!-- price groups by different colors -->

                                <div class="border-y-4 pb-6 pt-2">
                                    <h4 class="text-right pb-4">
                                        گروه بندی قیمت ها
                                    </h4>
                                    <div class="flex">
                                        <div class="w-2/3">
                                            <div
                                                class="flex gap-1 border-b-6 items-center w-full"
                                                v-for="(
                                                    priceGroup, index
                                                ) of state.productColors"
                                                :key="index"
                                            >
                                                <!-- color combo box -->
                                                <div
                                                    class="md:w-full text-center"
                                                >
                                                    <Dropdown
                                                        align="right"
                                                        width="44"
                                                    >
                                                        <template #trigger>
                                                            <div class="flex">
                                                                <div
                                                                    class="flex gap-1"
                                                                >
                                                                    <span
                                                                        :style="{
                                                                            backgroundColor:
                                                                                priceGroup.en_name,
                                                                        }"
                                                                        class="block w-6 h-6 rounded-full border"
                                                                    ></span>
                                                                    <p
                                                                        v-text="
                                                                            priceGroup.fa_name
                                                                        "
                                                                    ></p>
                                                                </div>

                                                                <i
                                                                    class="bi bi-chevron-down px-2"
                                                                ></i>
                                                            </div>
                                                        </template>

                                                        <template #content>
                                                            <div
                                                                v-for="color of colors"
                                                                :key="color.id"
                                                            >
                                                                <div
                                                                    @click="
                                                                        chooseColor(
                                                                            index,
                                                                            color
                                                                        )
                                                                    "
                                                                    class="block cursor-pointer text-gray-50 hover:bg-gray-600 select-none p-2 text-center peer-checked:bg-gray-500 peer-checked:font-bold peer-checked:text-white"
                                                                >
                                                                    {{
                                                                        color.fa_name
                                                                    }}
                                                                </div>
                                                            </div>
                                                        </template>
                                                    </Dropdown>
                                                </div>
                                                <div class="md:w-full">
                                                    <label
                                                    class="block text-grey-darker text-sm font-bold mb-2"
                                                >
                                                    قیمت
                                                </label>
                                                    <input
                                                        type="number"
                                                        v-model="
                                                            priceGroup.pivot
                                                                .price
                                                        "
                                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-3"
                                                    />
                                                </div>

                                                <div class="md:w-full">
                                                    <label
                                                    class="block text-grey-darker text-sm font-bold mb-2"
                                                >
                                                    موجودی
                                                </label>
                                                    <input
                                                        type="number"
                                                        v-model="
                                                            priceGroup.pivot
                                                                .stock
                                                        "
                                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-3"
                                                    />
                                                </div>

                                                <button
                                                    v-if="index != 0"
                                                    @click="
                                                        removePriceGroup(index)
                                                    "
                                                    type="button"
                                                    class="inline-flex text-xl items-center px-3 py-1 duration-100 transition-all hover:scale-110 text-red-500 font-medium rounded-md"
                                                >
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="w-1/3">
                                            <button
                                                @click="addPriceGroup()"
                                                type="button"
                                                class="inline-flex text-lg items-center px-3 py-1 bg-green-600 hover:scale-105 active:scale-100 duration-150 transition-all text-gray-100 font-medium rounded-md"
                                            >
                                                + اضافه کردن
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-b-4 pb-6 pt-2">
                                    <h4 class="text-right pb-4">ویژگی ها</h4>
                                    <div class="flex">
                                        <div class="w-2/3">
                                            <div
                                                class="flex gap-1 border-b-6 items-center w-full"
                                                v-for="(
                                                    attr, index
                                                ) of state.productAttributes"
                                                :key="index"
                                            >
                                                <div class="md:w-full">
                                                    عنوان
                                                    <input
                                                        type="text"
                                                        v-model="attr.title"
                                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-3"
                                                    />
                                                </div>

                                                <div class="md:w-full">
                                                    مقدار
                                                    <input
                                                        type="text"
                                                        v-model="attr.value"
                                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-2 px-4 mb-3"
                                                    />
                                                </div>

                                                <button
                                                    v-if="index != 0"
                                                    @click="
                                                        removeProductAttribute(
                                                            index
                                                        )
                                                    "
                                                    type="button"
                                                    class="inline-flex text-xl items-center px-3 py-1 duration-100 transition-all hover:scale-110 text-red-500 font-medium rounded-md"
                                                >
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="w-1/3">
                                            <button
                                                @click="addProductAttribute()"
                                                type="button"
                                                class="inline-flex text-lg items-center px-3 py-1 bg-green-600 hover:scale-105 active:scale-100 duration-150 transition-all text-gray-100 font-medium rounded-md"
                                            >
                                                + اضافه کردن
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end mt-4">
                                    <PrimaryButton
                                        class="ml-4 bg-stone-600 text-lg px-10"
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        اعمال تغییرات
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
