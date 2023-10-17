<template>
    <Layout>
        <div
            class="flex flex-col justify-center items-center gap-2 my-4 mx-1 sm:flex-row sm:w-1/2 sm:mx-auto"
        >
            <input
                v-model="search"
                name="search"
                type="text"
                placeholder="Pesquisar por nome ou CPF..."
                class="w-full p-3 rounded bg-zinc-100 focus:outline-none focus:bg-emerald-100 border-2 border-zinc-800"
            />
            <Link
                class="w-full p-3 border-2 border-zinc-800 rounded text-lg text-center font-bold bg-emerald-400 hover:bg-emerald-400/80"
                href="/person/create"
            >
                Novo Contribuinte
            </Link>
        </div>
        <no-results :size="people.length" />
        <div class="flex flex-col">
            <card
                v-for="person in props.people"
                :key="person.id"
                :person="person"
            />
        </div>
    </Layout>
</template>

<script setup>
import Layout from "../Shared/Layout.vue";
import NoResults from "../Shared/NoResults.vue";
import Card from "./Card.vue";
import { Link } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    people: Array,
    filters: Object,
});

let search = ref(props.filters.search);
watch(search, (value) => {
    router.get(
        "/person/all",
        { search: value },
        { preserveState: true, replace: true }
    );
});
</script>
