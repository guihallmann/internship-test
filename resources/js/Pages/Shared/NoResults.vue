<template lang="">
    <span
        v-if="!size"
        class="flex justify-center items-center p-10 text-lg text-justify text-zinc-800 font-bold sm:text-3xl"
    >
        Nenhum resultado encontrado...
    </span>
</template>
<script setup>
const props = defineProps({
    size: Number,
});
</script>
