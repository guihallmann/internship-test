<template>
    <layout>
        <div class="flex justify-center">
            <create-person />
        </div>
    </layout>
</template>
<script>
import Layout from "../Shared/Layout.vue";
import CreatePerson from "../Shared/Forms/CreatePerson.vue";

export default {
    components: {
        Layout,
        CreatePerson,
    },
};
</script>
