<template>
    <layout>
        <div class="flex justify-center">
            <edit-department :department="department" />
        </div>
    </layout>
</template>
<script>
import Layout from "../Shared/Layout.vue";
import EditDepartment from "../Shared/Forms/EditDepartment.vue";

export default {
    components: {
        Layout,
        EditDepartment,
    },
    props: {
        department: Object,
    },
};
</script>
