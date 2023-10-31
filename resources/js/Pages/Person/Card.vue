<template>
    <div
        class="grid grid-rows-6 space-y-0.5 items-start justify-items-start border-2 border-zinc-800 rounded m-1 p-4 bg-zinc-100 font-normal text-xl hover:bg-zinc-200/80 sm:grid-cols-6 sm:grid-rows-none"
    >
        <span><strong>CPF: </strong>{{ formatCpf(person.cpf) }}</span>
        <span><strong>Nome: </strong>{{ person.name }}</span>
        <span
            ><strong>Nascimento: </strong>
            {{ formatDate(person.birthday) }}
        </span>
        <span><strong>Sexo: </strong>{{ person.sex }}</span>
        <span>
            <strong>Endereço: </strong>

            {{ formatAddress(person) }}
        </span>
        <div class="flex justify-center items-center w-full h-full gap-4">
            <nav-link
                class="font-medium bg-amber-500 p-2 rounded-sm text-white hover:bg-amber-600 shadow-md"
                :href="route('edit-person', { id: person.id })"
                as="button"
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
        @delete="destroyPerson(person.id)"
    />
</template>

<script setup>
import NavLink from "../Shared/NavLink.vue";
import DeleteModal from "../Shared/DeleteModal.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { formatDate } from "../../utils/date";
import { formatAddress } from "../../utils/address";
import { formatCpf } from "../../utils/cpf";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const showModal = ref(false);

const props = defineProps({
    person: Object,
});

const destroyPerson = (id) => {
    router.delete(route("destroy-person", id), {
        onSuccess: () => {
            toast.error("Contribuinte excluído com sucesso!");
        },
    });
};
</script>
