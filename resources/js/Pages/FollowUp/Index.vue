<template>
    <layout>
        <no-results :size="followUps.length" />
        <div class="flex flex-col mt-4">
            <card
                v-for="followUp in props.followUps"
                :key="followUp.id"
                :followUp="followUp"
            />
        </div>
    </layout>
</template>
<script setup>
import Layout from "../Shared/Layout.vue";
import NoResults from "../Shared/NoResults.vue";
import Card from "./Card.vue";
const props = defineProps({
    followUps: Array,
});
</script>
