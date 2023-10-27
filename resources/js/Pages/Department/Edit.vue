<template>
    <layout>
        <div class="flex justify-center">
            <edit-department :department="department" />
        </div>
    </layout>
</template>
<script setup>
import Layout from "../Shared/Layout.vue";
import EditDepartment from "../Shared/Forms/EditDepartment.vue";

const props = defineProps({
    department: Object,
});
</script>
