<template>
    <layout>
        <div class="flex justify-center">
            <create-user />
        </div>
    </layout>
</template>
<script>
import Layout from "../Shared/Layout.vue";
import CreateUser from "../Shared/Forms/CreateUser.vue";

export default {
    components: {
        Layout,
        CreateUser,
    },
};
</script>
