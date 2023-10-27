<template>
    <div
        class="grid grid-rows-6 space-y-0.5 items-start justify-items-start border-2 border-zinc-800 rounded m-1 p-4 bg-zinc-100 font-normal text-xl hover:bg-zinc-200/80 sm:grid-cols-6 sm:grid-rows-none sm:space-x-0.5"
    >
        <span><strong>Nome: </strong>{{ user.name }}</span>
        <span><strong>Email: </strong>{{ user.email }}</span>
        <span><strong>CPF: </strong>{{ user.cpf }}</span>
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
            <nav-link
                v-if="!removeButton"
                class="font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600"
                as="button"
                :href="route('destroy-user', { id: user.id })"
                method="delete"
            >
                Excluir
            </nav-link>
            <nav-link
                v-if="removeButton"
                class="font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600"
                as="button"
                :href="
                    route('remove-user-from-department', {
                        user_id: user.pivot.user_id,
                        department_id: user.pivot.department_id,
                    })
                "
                method="delete"
            >
                Remover
            </nav-link>
        </div>
    </div>
</template>

<script setup>
import NavLink from "../Shared/NavLink.vue";
import { formatDate } from "../../utils/date";

const props = defineProps({
    user: Object,
    removeButton: Boolean,
});
</script>
