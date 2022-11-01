<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, watch } from "vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const previewImage = ref(null);
const imageUrl = ref(null);

const form = useForm({
    name: "",
    description: "",
    price: "",
    balance: 0,
    image: null,
});

const addproduct = () => {
    form.post(route("product.store"), {
        onFinish: () => {
            alert("product added successfully");
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

<template>
    <Head title="Create Product" />

    <section class="bg-gray-300">
        <div class="mx-auto max-w-screen-xl px-4 py-5 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-x-16 gap-y-8 lg:grid-cols-5">
                <div class="lg:col-span-2 lg:py-12">
                    <a href="#" class="">
                        <img
                            v-if="previewImage == null"
                            alt="Headphones"
                            src="./image-prev.png"
                            class="h-[300px] w-full spacity-20 object-cover sm:h-[350px]"
                        />
                        <img
                            v-else
                            alt="Headphones"
                            :src="imageUrl"
                            class="h-[300px] w-full object-cover sm:h-[350px]"
                        />

                        <div class="mt-2 space-y-3">
                            <p class="text-xl text-gray-700">{{ form.name }}</p>

                            <div class="flex justify-between text-sm">
                                <h3>{{ form.description }}</h3>

                                <p v-if="form.price">
                                    {{ form.price }}
                                    <span class="">$</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <div
                    class="rounded-lg bg-gray-400 p-4 shadow-lg lg:col-span-3 lg:p-4"
                >
                    <form
                        @submit.prevent="addproduct"
                        class="space-y-4"
                        enctype="multipart/form-data"
                    >
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
                        <div>
                            <InputLabel for="name" value="name" />
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                placeholder="name"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <InputLabel for="price" value="price" />
                                <TextInput
                                    id="price"
                                    v-model="form.price"
                                    type="number"
                                    placeholder="price"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.price"
                                />
                            </div>
                            <div>
                                <InputLabel for="balance" value="balance" />
                                <TextInput
                                    id="balance"
                                    v-model="form.balance"
                                    type="number"
                                    placeholder="balance"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.balance"
                                />
                            </div>
                        </div>
                        <div>
                            <InputLabel for="description" value="description" />
                            <textarea
                                class="w-full rounded-lg border-gray-200 p-3 text-lg"
                                placeholder="Description"
                                rows="8"
                                v-model="form.description"
                                name="description"
                            ></textarea>
                        </div>

                        <div class="flex justify-end mt-4">
                            <PrimaryButton
                                class="ml-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Add
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
<style>
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
</style>
