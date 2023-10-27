<template>
    <div
        class="grid grid-rows-6 space-y-0.5 items-start justify-items-start border-2 border-zinc-800 rounded m-1 p-4 bg-zinc-100 font-normal text-xl hover:bg-zinc-200/80 sm:grid-cols-6 sm:grid-rows-none sm:space-x-0.5"
    >
        <span><strong>ID: </strong>{{ followUp.id }}</span>
        <span><strong>Observação: </strong>{{ followUp.observation }}</span>
        <span> <strong>Protocolo: </strong>{{ followUp.protocol_id }} </span>

        <span> <strong>Contribuinte: </strong>{{ followUp.user_id }} </span>
        <span
            ><strong>Cadastrado em: </strong
            >{{ formatDate(followUp.created_at) }}</span
        >
        <div class="flex justify-center items-center w-full gap-4">
            <nav-link
                class="font-medium bg-amber-500 p-2 rounded-sm text-white hover:bg-amber-600 shadow-md"
                as="button"
                :href="route('edit-followUp', { id: followUp.id })"
                method="get"
            >
                Editar
            </nav-link>
            <nav-link
                class="font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600 shadow-md"
                as="button"
                :href="route('destroy-followUp', { id: followUp.id })"
                method="delete"
            >
                Excluir
            </nav-link>
        </div>
    </div>
</template>

<script setup>
import NavLink from "../Shared/NavLink.vue";
import { formatDate } from "../../utils/date";

const props = defineProps({
    followUp: Object,
});
</script>
