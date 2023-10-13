<template>
    <layout>
        <div class="flex flex-col">
            <protocol-card
                v-for="protocol in protocols"
                :key="protocol.id"
                :protocol="protocol"
            />
        </div>
        <div
            v-if="!protocols.length"
            class="flex justify-center items-center p-4 mt-4"
        >
            <span class="font-medium text-xl text-zinc-800 sm:text-3xl"
                >Nenhum resultado encontrado!</span
            >
        </div>
    </layout>
</template>
<script>
import Layout from "./Shared/Layout.vue";
import ProtocolCard from "./Shared/ProtocolCard.vue";
export default {
    components: {
        Layout,
        ProtocolCard,
    },
    props: {
        protocols: Array,
    },
};
</script>
