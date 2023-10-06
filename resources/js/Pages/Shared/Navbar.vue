<template>
    <nav class="bg-zinc-800 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div>
                <span class="text-white text-3xl font-bold">I.T.S</span>
            </div>
            <div>
                <nav-link
                    class="text-xl text-white"
                    href="/logout"
                    method="post"
                    as="button"
                >
                    Sair
                </nav-link>
            </div>
        </div>
    </nav>
</template>
<script>
import NavLink from "./NavLink.vue";
export default {
    components: { NavLink },
};
</script>
