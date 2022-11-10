<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetLabel from "@/Components/Label.vue";


let props = defineProps({
  product_id: Number
})


const form = useForm({
  body: '',
  product_id: props.product_id
});

const submit = () => {
  form.post(route('comment'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
  });
};
</script>

<template>

  <form @submit.prevent="submit" class="w-full max-w-lg bg-gray-300 rounded-lg px-4 pt-2">
    <div class="flex flex-wrap -mx-3 mb-6">
      <h2 class="px-4 pt-3 pb-2 text-gray-800 text-lg">Add a new comment</h2>
      <div class="w-full md:w-full px-3 mb-2 mt-2">
        <div>
          <JetLabel for="body" value="body" />
          <JetInput id="body" v-model="form.body" type="text" class="mt-1 h-16 block w-full" required autofocus />
          <JetInputError class="mt-2" :message="form.errors.body" />
        </div>
      </div>
      <div class="w-full md:w-full flex items-start px-3">
        <div class="-mr-1">
          <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Post comment
          </PrimaryButton>
        </div>
      </div>
    </div>
  </form>
</template>
