<template>
    <layout>
        <div class="flex justify-center">
            <edit-person :person="person" />
        </div>
    </layout>
</template>
<script setup>
import Layout from "../Shared/Layout.vue";
import EditPerson from "../Shared/Forms/EditPerson.vue";

const props = defineProps({
    person: Object,
});
</script>
