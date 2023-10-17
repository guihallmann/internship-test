<template>
    <layout>
        <div class="flex justify-center">
            <edit-user :user="user" />
        </div>
    </layout>
</template>
<script>
import Layout from "../Shared/Layout.vue";
import EditUser from "../Shared/Forms/EditUser.vue";

export default {
    components: {
        Layout,
        EditUser,
    },
    props: {
        user: Object,
    },
};
</script>
