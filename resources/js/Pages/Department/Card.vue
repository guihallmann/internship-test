<template>
    <div
        class="grid grid-rows-2 space-y-0.5 items-start justify-items-start border-2 border-zinc-800 rounded m-1 p-4 bg-zinc-100 font-normal text-xl hover:bg-zinc-200/80 sm:flex-col"
    >
        <span class="flex justify-center font-bold text-2xl w-full gap-1">{{
            department.name
        }}</span>
        <div class="flex justify-start items-center w-full h-full gap-4">
            <nav-link
                class="w-full font-medium bg-emerald-500 p-2 rounded-sm text-white hover:bg-emerald-600 shadow-md"
                :href="route('show-department', { id: department.id })"
                as="button"
            >
                Detalhes
            </nav-link>
            <nav-link
                class="w-full font-medium bg-amber-500 p-2 rounded-sm text-white hover:bg-amber-600 shadow-md"
                :href="route('edit-department', { id: department.id })"
                as="button"
            >
                Editar
            </nav-link>
            <nav-link
                class="w-full font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600 shadow-md"
                :href="route('destroy-department', { id: department.id })"
                as="button"
                method="delete"
            >
                Excluir
            </nav-link>
        </div>
    </div>
</template>

<script setup>
import NavLink from "../Shared/NavLink.vue";

const props = defineProps({
    department: Object,
});
</script>
