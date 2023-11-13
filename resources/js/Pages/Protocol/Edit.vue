<template>
    <layout>
        <div class="flex flex-col justify-center">
            <edit-protocol
                :protocol="protocol"
                :people="people"
                :departments="departments"
            />
            <create-follow-up :protocol_id="protocol.id" />
            <create-attachment :protocol="protocol" />
        </div>
    </layout>
</template>
<script setup>
import Layout from "../Shared/Layout.vue";
import EditProtocol from "../Shared/Forms/EditProtocol.vue";
import CreateFollowUp from "../Shared/Forms/CreateFollowUp.vue";
import createAttachment from "../Shared/Forms/createAttachment.vue";

const props = defineProps({
    protocol: Object,
    people: Array,
    departments: Array,
});
</script>
