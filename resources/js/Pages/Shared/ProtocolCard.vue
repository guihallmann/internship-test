<template>
    <div
        class="grid grid-rows-6 space-y-0.5 items-center justify-items-start border-2 border-zinc-800 rounded m-1 p-4 bg-zinc-100 font-normal text-xl hover:bg-zinc-200/80 sm:grid-cols-6 sm:grid-rows-none"
    >
        <span><strong>ID: </strong>{{ protocol.id }}</span>
        <span><strong>Descrição: </strong>{{ protocol.description }}</span>
        <span><strong>Prazo: </strong>{{ protocol.deadline }}</span>
        <span><strong>Contribuinte: </strong>{{ protocol.person.name }}</span>
        <span><strong>CPF: </strong>{{ protocol.person.cpf }}</span>
        <div class="flex justify-center items-center w-full gap-4">
            <nav-link
                class="font-medium text-amber-500 hover:underline"
                as="button"
            >
                Editar
            </nav-link>
            <nav-link
                class="font-medium text-rose-500 hover:underline"
                as="button"
                :href="route('delete-protocol', { id: protocol.id })"
                method="delete"
            >
                Excluir
            </nav-link>
        </div>
    </div>
</template>

<script>
import NavLink from "./NavLink.vue";
export default {
    components: { NavLink },
    props: {
        protocol: Object,
    },
};
</script>
