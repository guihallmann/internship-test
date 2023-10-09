<template>
    <section>
        <header>
            <navbar></navbar>
        </header>
    </section>
    <section>
        <slot />
    </section>
</template>
<script>
import Navbar from "./Navbar.vue";
export default {
    components: { Navbar },
};
</script>
