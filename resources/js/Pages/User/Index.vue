<template>
    <layout>
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
                href="/user/create"
            >
                Novo Usuário
            </Link>
        </div>
        <no-results :size="users.length" />
        <div class="flex flex-col">
            <card v-for="user in props.users" :key="user.id" :user="user" />
        </div>
    </layout>
</template>
<script setup>
import Layout from "../Shared/Layout.vue";
import NoResults from "../Shared/NoResults.vue";
import { Link } from "@inertiajs/vue3";
import Card from "./Card.vue";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    users: Array,
    filters: Object,
});

let search = ref(props.filters.search);
watch(search, (value) => {
    router.get(
        "/user/all",
        { search: value },
        { preserveState: true, replace: true }
    );
});
</script>
