<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Components/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetLabel from "@/Components/Label.vue";
import { ref, onMounted } from "vue";

let showForm = ref(false);

const form = useForm({
    mobile: "",
    password: "",
    password_confirmation: "",
    // terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};

onMounted(() => {
    setTimeout(() => {
        showForm.value = true;
    }, 50);
});
</script>

<template>
    <Head title="Register" />

    <div class="flex">
        <img
            class="object-cover w-full h-screen"
            src="./pics/astronat.jpg"
            alt=""
        />
        <Transition name="slide-fade">
            <div
                v-if="showForm"
                class="w-[400px] p-4 absolute top-20 left-24 m-5 backdrop-blur-sm bg-white/20"
            >
                <form @submit.prevent="submit">
                    <h1 class="text-2xl font-bold mb-4">ٍثبت نام</h1>

                    <div class="mt-4">
                        <JetLabel
                            class="text-stone-800"
                            for="mobile"
                            value=" ایمیل یا موبایل "
                        />
                        <JetInput
                            id="mobile"
                            v-model="form.mobile"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <JetInputError
                            class="mt-2"
                            :message="form.errors.mobile"
                        />
                    </div>

                    <div class="flex gap-2 py-3">
                        <div class="mt-4">
                            <JetLabel
                                class="text-stone-800"
                                for="password"
                                value="رمز عبور"
                            />
                            <JetInput
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autocomplete="new-password"
                            />
                            <JetInputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                        </div>

                        <div class="mt-4">
                            <JetLabel
                                class="text-stone-800"
                                for="password_confirmation"
                                value="تایید رمز عبور "
                            />
                            <JetInput
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autocomplete="new-password"
                            />
                            <JetInputError
                                class="mt-2"
                                :message="form.errors.password_confirmation"
                            />
                        </div>
                    </div>

                    <div
                        class="flex w-full mt-8 justify-between items-baseline"
                    >
                        <JetButton
                            class="m-4 w-1/2 bg-stone-400 hover:bg-yellow-500 hover:text-stone-800"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            ثبت نام
                        </JetButton>
                        <Link
                            :href="route('login')"
                            class="text-md animate-pulse align-middle text-gray-200 hover:text-gray-900"
                        >
                            قبلا ثبت نام کرده اید؟
                        </Link>
                    </div>
                </form>
            </div>
        </Transition>
    </div>
</template>
