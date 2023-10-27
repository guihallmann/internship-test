<template>
    <layout>
        <div class="flex justify-center">
            <edit-user :user="user" />
        </div>
    </layout>
</template>
<script setup>
import Layout from "../Shared/Layout.vue";
import EditUser from "../Shared/Forms/EditUser.vue";

const props = defineProps({
    user: Object,
});
</script>
