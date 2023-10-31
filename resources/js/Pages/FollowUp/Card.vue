<template>
    <div
        class="grid grid-rows-6 space-y-0.5 items-start justify-items-start border-2 border-zinc-800 rounded m-1 p-4 bg-zinc-100 font-normal text-xl hover:bg-zinc-200/80 sm:grid-cols-6 sm:grid-rows-none sm:space-x-0.5"
    >
        <span><strong>ID: </strong>{{ followUp.id }}</span>
        <span><strong>Observação: </strong>{{ followUp.observation }}</span>
        <span> <strong>Protocolo: </strong>{{ followUp.protocol_id }} </span>

        <span> <strong>Usuário: </strong>{{ followUp.user_id }} </span>
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
        @delete="destroyFollowUp(followUp.id)"
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
    followUp: Object,
});

const destroyFollowUp = (id) => {
    router.delete(route("destroy-followUp", id), {
        onSuccess: () => {
            toast.error("Acompanhamento excluído com sucesso!");
        },
    });
};
</script>
