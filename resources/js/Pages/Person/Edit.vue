<template>
    <layout>
        <div class="flex justify-center">
            <edit-person :person="person" />
        </div>
    </layout>
</template>
<script>
import Layout from "../Shared/Layout.vue";
import EditPerson from "../Shared/Forms/EditPerson.vue";

export default {
    components: {
        Layout,
        EditPerson,
    },
    props: {
        person: Object,
    },
};
</script>
