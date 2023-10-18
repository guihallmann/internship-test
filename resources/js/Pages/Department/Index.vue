<template>
    <Layout>
        <div
            class="flex flex-col justify-center items-center my-4 mx-1 sm:flex-row sm:w-1/4 sm:mx-auto"
        >
            <Link
                class="w-full p-3 border-2 border-zinc-800 rounded text-lg text-center font-bold bg-emerald-400 hover:bg-emerald-400/80"
                href="/department/create"
            >
                Novo Departamento
            </Link>
        </div>
        <no-results :size="departments.length" />
        <div class="grid grid-cols-1 sm:grid-cols-5 w-full">
            <card
                v-for="department in props.departments"
                :key="department.id"
                :department="department"
            />
        </div>
    </Layout>
</template>

<script setup>
import Layout from "../Shared/Layout.vue";
import NoResults from "../Shared/NoResults.vue";
import Card from "./Card.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    departments: Array,
});
</script>
