<template>
    <nav
        class="flex w-full justify-between items-center bg-zinc-800 p-4 shadow-md"
    >
        <nav-link class="text-white text-3xl font-bold" href="/">
            I.T.S
        </nav-link>

        <nav-link
            class="text-xl text-white hover:underline"
            href="/logout"
            method="post"
            as="button"
        >
            Sair
        </nav-link>
    </nav>
</template>
<script>
import NavLink from "./NavLink.vue";
export default {
    components: { NavLink },
};
</script>
