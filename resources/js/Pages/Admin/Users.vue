<script setup>
import Sidebar from "./Sidebar.vue";
import Table from "@/Components/Table.vue";

</script>

<template>
    <BackofficeLayout> </BackofficeLayout>
    <div class="flex">
        <Sidebar />
        <div class="flex-1"> <Table/> </div>
    </div>
</template>
