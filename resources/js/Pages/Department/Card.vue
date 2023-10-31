<template>
    <div
        class="grid grid-rows-2 space-y-0.5 items-start justify-items-start border-2 border-zinc-800 rounded m-1 p-4 bg-zinc-100 font-normal text-xl hover:bg-zinc-200/80 sm:flex-col"
    >
        <span class="flex justify-center font-bold text-2xl w-full gap-1">{{
            department.name
        }}</span>
        <div class="flex justify-start items-center w-full h-full gap-8">
            <nav-link
                class="w-1/3 font-medium bg-emerald-500 p-2 rounded-sm text-white hover:bg-emerald-600 shadow-md"
                :href="route('show-department', { id: department.id })"
                as="button"
            >
                Detalhes
            </nav-link>
            <nav-link
                class="w-1/3 font-medium bg-amber-500 p-2 rounded-sm text-white hover:bg-amber-600 shadow-md"
                :href="route('edit-department', { id: department.id })"
                as="button"
            >
                Editar
            </nav-link>
            <button
                class="w-1/3 font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600 shadow-md"
                type="button"
                @click="showModal = !showModal"
            >
                Excluir
            </button>
        </div>
        <delete-modal
            :active="showModal"
            @cancel="showModal = false"
            @delete="destroyDepartment(department.id)"
        />
    </div>
</template>

<script setup>
import NavLink from "../Shared/NavLink.vue";
import DeleteModal from "../Shared/DeleteModal.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const showModal = ref(false);

const props = defineProps({
    department: Object,
});

const destroyDepartment = (id) => {
    router.delete(route("destroy-department", id), {
        onSuccess: () => {
            toast.error("Acompanhamento excluído com sucesso!");
        },
    });
};
</script>
