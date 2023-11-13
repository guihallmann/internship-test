<template lang="">
    <Link
        class="w-24 text-center font-medium bg-emerald-500 p-2 rounded-sm text-white hover:bg-emerald-600 shadow-md"
        :href="url"
    >
        Novo
    </Link>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    url: String,
});
</script>
