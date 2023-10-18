<template>
    <layout>
        <div class="flex justify-center">
            <create-department :departments="departments" />
        </div>
    </layout>
</template>
<script>
import Layout from "../Shared/Layout.vue";
import CreateDepartment from "../Shared/Forms/CreateDepartment.vue";

export default {
    components: {
        Layout,
        CreateDepartment,
    },
    props: {
        departments: Array,
    },
};
</script>
