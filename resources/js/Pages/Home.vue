<template>
    <layout>
        <div class="flex flex-col justify-center items-center p-4 m-2">
            <card href="/create-person">
                Novo Contribuinte
                <icon name="add-user" />
            </card>
            <card href="/create-protocol">
                Novo Protocolo
                <icon name="add-prot" />
            </card>
        </div>
    </layout>
</template>
<script>
import Card from "./Shared/Card.vue";
import Layout from "./Shared/Layout.vue";
import Icon from "./Shared/Icon.vue";
export default {
    components: {
        Card,
        Layout,
        Icon,
    },
};
</script>
