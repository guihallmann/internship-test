<template>
    <layout>
        <div class="flex flex-col">
            <person-card
                v-for="person in people"
                :key="person.id"
                :person="person"
            />
        </div>

        <!-- <create-person></create-person> -->
    </layout>
</template>
<script>
import Layout from "./Shared/Layout.vue";
import CreatePerson from "./Shared/Forms/CreatePerson.vue";
import PersonCard from "./Shared/PersonCard.vue";
export default {
    components: {
        Layout,
        CreatePerson,
        PersonCard,
    },
    props: {
        people: Array,
    },
};
</script>
