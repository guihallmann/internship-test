<template>
    <Link :class="{ underline: active }">
        <slot />
    </Link>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    active: Boolean,
});
</script>
