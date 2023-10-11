<template>
    <Link
        class="flex justify-center items-center gap-3 border-2 border-zinc-800 rounded px-10 py-6 bg-zinc-100 font-bold text-2xl hover:bg-zinc-200 m-2 w-full text-center sm:max-w-md"
    >
        <slot />
    </Link>
</template>
<script>
import { Link } from "@inertiajs/vue3";
export default {
    components: { Link },
};
</script>
