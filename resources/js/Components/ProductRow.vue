<script setup>
import { onMounted, ref } from "vue";
import { useProductStore } from "@/store/Product.js";

const storeProduct = useProductStore();

defineProps({
    product: Number,
});

let showItem = ref(false);

const deleteProduct = (id) => {
    showItem.value = false;
    storeProduct.deleteProduct(id);
};

onMounted(() => {
    setTimeout(() => {
        showItem.value = true;
    }, 10);
});
</script>

<template>
    <Transition name="fade">
        <tr v-if="showItem" class="bg-gray-200 mx-3 py-1">
            <td class="p-3">
                <div class="flex items-center">
                    <img
                        class="rounded-full h-12 w-12 object-cover"
                        :src="product.image_url"
                        alt="unsplash image"
                    />
                    <div class="ml-3">
                        <div class="text-yellow-900">
                            {{ product.title }}
                        </div>
                    </div>
                </div>
            </td>
            <td class="p-3 text-slate-900">
                {{ product.categories[0].name }}
            </td>
            <td class="p-3 font-bold text-yellow-600">
                {{ product.default_price }}
            </td>
            <td class="p-3">
                <span class="text-gray-500 rounded-md px-2">
                    {{ product.stock }}</span
                >
            </td>
            <td class="p-3">
                <span
                    @click="deleteProduct(product.id)"
                    class="text-gray-400 hover:text-gray-100 mr-2"
                >
                    <i class="bi bi-trash3-fill"></i>
                </span>
                <span
                    @click="storeProduct.showProductEditPage(product.id)"
                    class="text-gray-400 hover:text-gray-100 mx-2"
                >
                    <i class="material-icons-outlined text-base text-yellow-500"
                        ><i class="bi bi-pen-fill"></i
                    ></i>
                </span>
            </td>
        </tr>
    </Transition>
</template>
<style scoped>
.fade-enter-active {
    transition: all 0.3s ease-out;
}

.fade-leave-active {
    transition: all 0.4s cubic-bezier(1, 0.5, 0.8, 1);
}

.fade-enter-from,
.fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>
