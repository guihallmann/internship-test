<template>
    <button
        class="w-24 font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600 shadow-md"
        type="button"
        @click="deleteFunction"
    >
        Excluir
    </button>
</template>
<script setup>
const props = defineProps({
    deleteFunction: Function,
});
</script>
