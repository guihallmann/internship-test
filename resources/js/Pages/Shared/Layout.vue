<template>
    <section>
        <header>
            <navbar />
        </header>
    </section>
    <section>
        <slot />
    </section>
</template>
<script setup>
import Navbar from "./Navbar.vue";
</script>
