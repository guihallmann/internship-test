<template>
    <layout>
        <div class="flex justify-center">
            <create-department :departments="departments" />
        </div>
    </layout>
</template>
<script setup>
import Layout from "../Shared/Layout.vue";
import CreateDepartment from "../Shared/Forms/CreateDepartment.vue";

const props = defineProps({
    departments: Array,
});
</script>
