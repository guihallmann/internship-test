<template>
    <div
        class="grid grid-rows-7 space-y-0.5 items-start justify-items-start border-2 border-zinc-800 rounded m-1 p-4 bg-zinc-100 font-normal text-xl hover:bg-zinc-200/80 sm:grid-cols-7 sm:grid-rows-none sm:space-x-0.5"
    >
        <span><strong>ID: </strong>{{ protocol.id }}</span>
        <span><strong>Descrição: </strong>{{ protocol.description }}</span>
        <span><strong>Prazo: </strong>{{ protocol.deadline }}</span>
        <span
            ><strong>Cadastrado em: </strong
            >{{ formatDate(protocol.created_at) }}</span
        >
        <span><strong>Contribuinte: </strong>{{ protocol.person.name }}</span>
        <span><strong>CPF: </strong>{{ protocol.person.cpf }}</span>
        <div class="flex justify-center items-center w-full gap-4">
            <nav-link
                class="font-medium bg-amber-500 p-2 rounded-sm text-white hover:bg-amber-600"
                as="button"
                :href="route('edit-protocol', { id: protocol.id })"
                method="get"
            >
                Editar
            </nav-link>
            <nav-link
                class="font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600"
                as="button"
                :href="route('destroy-protocol', { id: protocol.id })"
                method="delete"
            >
                Excluir
            </nav-link>
        </div>
    </div>
</template>

<script>
import NavLink from "../Shared/NavLink.vue";
export default {
    components: { NavLink },
    props: {
        protocol: Object,
    },
    methods: {
        formatDate(date) {
            const dateUTC = new Date(Date.parse(date));
            const localDate = dateUTC.toLocaleDateString("pt-BR", {
                year: "numeric",
                month: "2-digit",
                day: "2-digit",
            });
            return localDate;
        },
    },
};
</script>
