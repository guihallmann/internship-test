<template>
    <div
        class="grid grid-rows-8 space-y-0.5 items-start justify-items-start border-2 border-zinc-800 rounded m-1 p-4 bg-zinc-100 font-normal text-xl hover:bg-zinc-200/80 sm:grid-cols-8 sm:grid-rows-none sm:space-x-0.5"
    >
        <span><strong>ID: </strong>{{ protocol.id }}</span>
        <span><strong>Descrição: </strong>{{ protocol.description }}</span>
        <span><strong>Prazo: </strong>{{ protocol.deadline }}</span>
        <span>
            <strong>Departamento: </strong>{{ protocol.department.name }}
        </span>
        <span
            ><strong>Cadastrado em: </strong
            >{{ formatDate(protocol.created_at) }}</span
        >
        <span><strong>Contribuinte: </strong>{{ protocol.person.name }}</span>
        <span><strong>CPF: </strong>{{ protocol.person.cpf }}</span>
        <div class="flex justify-center items-center w-full gap-4">
            <nav-link
                class="font-medium bg-amber-500 p-2 rounded-sm text-white hover:bg-amber-600 shadow-md"
                as="button"
                :href="route('edit-protocol', { id: protocol.id })"
                method="get"
            >
                Editar
            </nav-link>
            <button
                class="font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600 shadow-md"
                type="button"
                @click="showModal = !showModal"
            >
                Excluir
            </button>
        </div>
    </div>
    <delete-modal
        :active="showModal"
        @cancel="showModal = false"
        @delete="destroyProtocol(protocol.id)"
    />
</template>

<script setup>
import NavLink from "../Shared/NavLink.vue";
import DeleteModal from "../Shared/DeleteModal.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { formatDate } from "../../utils/date";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const showModal = ref(false);

const props = defineProps({
    protocol: Object,
});

const destroyProtocol = (id) => {
    router.delete(route("destroy-protocol", id), {
        onSuccess: () => {
            toast.error("Protocolo excluído com sucesso!");
        },
    });
};
</script>
