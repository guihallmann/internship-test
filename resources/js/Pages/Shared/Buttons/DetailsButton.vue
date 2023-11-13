<template>
    <button
        class="w-36 text-center font-medium bg-cyan-500 p-2 rounded-sm text-white hover:bg-cyan-600 shadow-md"
        type="button"
        @click="detailsFunction"
    >
        Detalhes
    </button>
</template>
<script setup>
const props = defineProps({
    detailsFunction: Function,
});
</script>
