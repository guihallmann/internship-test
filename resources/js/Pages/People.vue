<template>
    <Layout>
        <div class="flex justify-center items-center my-4">
            <input
                v-model="search"
                name="search"
                type="text"
                placeholder="Pesquisar por nome ou CPF..."
                class="w-full mx-1 p-3 rounded bg-zinc-100 focus:outline-none focus:bg-emerald-100 border-2 border-zinc-800 sm:w-1/3"
            />
        </div>
        <div class="flex flex-col">
            <PersonCard
                v-for="person in props.people"
                :key="person.id"
                :person="person"
            />
        </div>
    </Layout>
</template>

<script setup>
import Layout from "./Shared/Layout.vue";
import PersonCard from "./Shared/PersonCard.vue";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    people: Array,
    filters: Object,
});

let search = ref(props.filters.search);
watch(search, (value) => {
    router.get(
        "/people",
        { search: value },
        { preserveState: true, replace: true }
    );
});
</script>
