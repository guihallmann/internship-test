<template>
    <layout>
        <div class="flex justify-center">
            <edit-person :person="person"></edit-person>
        </div>

        <!-- <create-person></create-person> -->
    </layout>
</template>
<script>
import Layout from "./Shared/Layout.vue";
import EditPerson from "./Shared/Forms/EditPerson.vue";

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
