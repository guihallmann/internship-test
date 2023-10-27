<template>
    <layout>
        <div class="flex flex-col justify-center">
            <edit-follow-up :followUp="followUp" />
        </div>
    </layout>
</template>
<script setup>
import Layout from "../Shared/Layout.vue";
import EditFollowUp from "../Shared/Forms/EditFollowUp.vue";

const props = defineProps({
    followUp: Object,
});
</script>
