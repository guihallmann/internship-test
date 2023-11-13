<template>
    <button
        class="w-24 font-medium p-2 rounded-sm text-white shadow-md bg-amber-500 hover:bg-amber-600"
        type="button"
        @click="editFunction"
    >
        Editar
    </button>
</template>
<script setup>
const props = defineProps({
    editFunction: Function,
});
</script>
