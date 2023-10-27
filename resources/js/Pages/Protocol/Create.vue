<template>
    <layout>
        <div class="flex justify-center">
            <create-protocol :people="people" :departments="departments" />
        </div>
    </layout>
</template>
<script setup>
import Layout from "../Shared/Layout.vue";
import CreateProtocol from "../Shared/Forms/CreateProtocol.vue";

const props = defineProps({
    people: Array,
    departments: Array,
});
</script>
