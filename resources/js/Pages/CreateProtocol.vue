<template>
    <layout>
        <div class="flex justify-center">
            <create-protocol :people="people" />
        </div>

        <!-- <create-person></create-person> -->
    </layout>
</template>
<script>
import Layout from "./Shared/Layout.vue";
import CreateProtocol from "./Shared/Forms/CreateProtocol.vue";
export default {
    components: {
        Layout,
        CreateProtocol,
    },
    props: {
        people: Array,
    },
};
</script>
