<template>
    <form @submit.prevent="addUser">
        <div
            class="flex flex-col justify-center items-center w-full sm:flex-row sm:gap-2 sm:w-1/2"
        >
            <div class="flex flex-col w-full mb-4">
                <label for="user_id" class="block tex-sm font-bold">
                    Adicionar usuário ao departamento
                </label>
                <select
                    name="user_id"
                    id="user_id"
                    v-model="form.user_id"
                    class="p-2 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                >
                    <option value="">Selecione um usuário</option>
                    <option v-for="user in users" :value="user.id">
                        {{ user.name }}
                    </option>
                </select>
                <span
                    v-if="form.errors.user_id"
                    v-text="form.errors.user_id"
                    class="text-rose-500 text-xs mt-1 font-medium"
                ></span>
            </div>
            <div
                class="flex justify-center items-center w-full sm:w-1/2 sm:mt-2"
            >
                <button
                    type="submit"
                    :disabled="form.processing || form.user_id === ''"
                    :class="
                        form.user_id === ''
                            ? 'bg-zinc-300 cursor-not-allowed'
                            : 'bg-emerald-400 hover:bg-emerald-400/80'
                    "
                    class="w-full border-2 border-zinc-800 rounded-sm text-lg font-bold p-2"
                >
                    Adicionar
                </button>
            </div>
        </div>
    </form>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const props = defineProps({
    departmentId: Number,
    users: Array,
});

let form = useForm({
    user_id: "",
    department_id: props.departmentId,
});

let addUser = () => {
    form.post("/department/add-user", {
        preserveScroll: true,
        onSuccess: () => {
            form.reset(), toast.success("Usuário adicionado ao departamento!");
        },
    });
};
</script>
