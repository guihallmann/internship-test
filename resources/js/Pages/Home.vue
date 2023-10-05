<template>
    <navbar></navbar>
    <create-person></create-person>
</template>
<script>
import Navbar from "./Shared/Navbar.vue";
import CreatePerson from "./Shared/Forms/CreatePerson.vue";
export default {
    components: {
        Navbar,
        CreatePerson,
    },
};
</script>
