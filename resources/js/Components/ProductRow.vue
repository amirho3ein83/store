<script setup>
import { onMounted, ref } from "vue";
import { useProductStore } from "@/store/Product.js";

const storeProduct = useProductStore();

defineProps({
    product: Object,
});

let showItem = ref(false);

const deleteProduct = (slug) => {
    showItem.value = false;
    storeProduct.deleteProduct(slug);
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
                    <div class="ml-3 flex gap-2">
                        <div class="text-yellow-900">
                            {{ product.title }}
                        </div>
                        <span
                            class="ml-2 text-sm font-bold text-yellow-700 dark:text-white"
                        >
                            {{ product.rate
                            }}<span
                                class="bi bi-star-fill text-yellow-500"
                            ></span>
                        </span>
                    </div>
                </div>
            </td>
            <td class="p-3">
                <div class="text-yellow-900">
                    {{ product.sold_qty }}
                </div>
            </td>
            <td class="p-3 text-slate-900">
                <span
                    class="inline-flex px-1"
                    v-for="category of product.categories"
                    :key="category.id"
                    v-text="category.name"
                >
                </span>
            </td>
            <td class="p-3 font-bold text-yellow-600">
                {{ product.default_price }}
            </td>
            <td class="p-3">
                <span
                    class="text-gray-500 rounded-md px-2"
                    v-text="product.stock"
                >
                </span>
            </td>
            <td class="p-3">
                <span
                    @click="deleteProduct(product.slug)"
                    class="text-red-400 hover:text-red-600 mr-2"
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

i {
    font-size: 20px;
}
</style>
