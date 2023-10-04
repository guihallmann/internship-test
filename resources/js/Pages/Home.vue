<template>
    <div class="flex justify-between">
        <h1 class="text-3xl">Home</h1>
        <nav-link href="/logout" method="post">Sair</nav-link>
    </div>
</template>
<script>
import NavLink from "./Shared/NavLink.vue";
export default {
    components: {
        NavLink,
    },
};
</script>
