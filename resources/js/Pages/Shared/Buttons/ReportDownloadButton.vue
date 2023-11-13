<template>
    <a
        :href="url"
        class="w-36 max-h-12 flex justify-center items-center gap-1 text-center font-medium bg-slate-500 p-2 rounded-sm text-white hover:bg-slate-600 shadow-md"
    >
        Relatório
        <icon name="download" />
    </a>
</template>
<script setup>
import Icon from "../Icon.vue";

const props = defineProps({
    url: String,
});
</script>
