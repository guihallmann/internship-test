<template>
    <div
        class="grid grid-rows-6 space-y-0.5 items-start justify-items-start border-2 border-zinc-800 rounded m-1 p-4 bg-zinc-100 font-normal text-xl hover:bg-zinc-200/80 sm:grid-cols-6 sm:grid-rows-none sm:space-x-0.5"
    >
        <span><strong>Nome: </strong>{{ user.name }}</span>
        <span><strong>Email: </strong>{{ user.email }}</span>
        <span><strong>CPF: </strong>{{ formatCpf(user.cpf) }}</span>
        <span><strong>Cargo: </strong>{{ user.role }}</span>
        <span
            ><strong>Cadastrado em: </strong
            >{{ formatDate(user.created_at) }}</span
        >
        <div class="flex justify-center items-center w-full gap-4">
            <nav-link
                v-if="!removeButton"
                class="font-medium bg-amber-500 p-2 rounded-sm text-white hover:bg-amber-600"
                as="button"
                :href="route('edit-user', { id: user.id })"
                method="get"
            >
                Editar
            </nav-link>
            <button
                v-if="!removeButton"
                class="font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600 shadow-md"
                type="button"
                @click="showModal = !showModal"
            >
                Excluir
            </button>
            <button
                v-if="removeButton"
                class="font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600 shadow-md"
                type="button"
                @click="showModal = !showModal"
            >
                Remover
            </button>
        </div>
    </div>
    <delete-modal
        :remove-button="removeButton"
        :active="showModal"
        @cancel="showModal = false"
        @delete="destroyUser(user.id)"
        @remove="removeUser(user.pivot.user_id, user.pivot.department_id)"
    />
</template>

<script setup>
import NavLink from "../Shared/NavLink.vue";
import DeleteModal from "../Shared/DeleteModal.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { formatDate } from "../../utils/date";
import { formatCpf } from "../../utils/cpf";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const showModal = ref(false);

const props = defineProps({
    user: Object,
    removeButton: Boolean,
});

const destroyUser = (id) => {
    router.delete(route("destroy-user", id), {
        onSuccess: () => {
            toast.error("Usuário excluído com sucesso!");
        },
    });
};

const removeUser = (userId, departmentId) => {
    router.delete(
        route("remove-user-from-department", {
            user_id: userId,
            department_id: departmentId,
        }),
        {
            onSuccess: () => {
                toast.error("Usuário removido do departamento com sucesso!");
            },
        }
    );
};
</script>
