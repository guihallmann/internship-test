<template>
    <layout>
        <div class="flex justify-center">
            <edit-protocol
                :protocol="protocol"
                :people="people"
            ></edit-protocol>
        </div>
    </layout>
</template>
<script>
import Layout from "./Shared/Layout.vue";
import EditProtocol from "./Shared/Forms/EditProtocol.vue";

export default {
    components: {
        Layout,
        EditProtocol,
    },
    props: {
        protocol: Object,
        people: Array,
    },
};
</script>
