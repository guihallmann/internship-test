<template>
    <layout>
        <div class="flex flex-col justify-center items-center p-4 m-2">
            <card href="/people">Contribuintes</card>
            <card href="">Protocolos</card>
        </div>
    </layout>
</template>
<script>
import Card from "./Shared/Card.vue";
import Layout from "./Shared/Layout.vue";
export default {
    components: {
        Card,
        Layout,
    },
};
</script>
