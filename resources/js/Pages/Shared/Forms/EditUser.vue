<template>
    <div class="flex w-full justify-center bg-zinc-50 p-4 mt-4 sm:mx-4">
        <div
            class="w-full mx-auto p-8 border-2 border-black rounded shadow-xl sm:max-w-full"
        >
            <div class="mb-4">
                <h1 class="text-2xl font-bold text-zinc-800">Editar Usuário</h1>
                <hr class="flex-grow" />
            </div>
            <form @submit.prevent="editUser">
                <div class="flex flex-col">
                    <div class="flex flex-col mb-4">
                        <label for="name" class="block text-sm font-bold">
                            Nome
                        </label>
                        <input
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            type="text"
                            name="name"
                            id="name"
                            placeholder="Nome completo"
                            v-model="form.name"
                        />
                        <span
                            v-if="form.errors.name"
                            v-text="form.errors.name"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="email" class="block text-sm font-bold">
                            Email
                        </label>
                        <input
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            type="text"
                            name="email"
                            id="email"
                            placeholder="Email"
                            v-model="form.email"
                        />
                        <span
                            v-if="form.errors.email"
                            v-text="form.errors.email"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="cpf" class="block text-sm font-bold">
                            CPF
                        </label>
                        <input
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            type="text"
                            name="cpf"
                            id="cpf"
                            placeholder="CPF"
                            v-model="form.cpf"
                            v-mask="['###.###.###-##']"
                        />
                        <span
                            v-if="form.errors.cpf"
                            v-text="form.errors.cpf"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="role" class="block text-sm font-bold">
                            Cargo
                        </label>
                        <select
                            name="role"
                            id="role"
                            v-model="form.role"
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                        >
                            <option value="">Cargo</option>
                            <option value="Ti">Admin TI</option>
                            <option value="Sys">Admin</option>
                            <option value="Op">Operador</option>
                        </select>
                        <span
                            v-if="form.errors.role"
                            v-text="form.errors.role"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>
                    <div class="flex justify-center">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full border-2 border-zinc-800 rounded-sm text-xl font-bold p-2 mt-4 bg-emerald-400 hover:bg-emerald-400/80 sm:w-1/4"
                        >
                            Salvar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const props = defineProps({
    user: Object,
});

let form = useForm({
    name: props.user.name,
    email: props.user.email,
    cpf: props.user.cpf,
    role: props.user.role,
});

const editUser = () => {
    form.put(`/user/edit/${props.user.id}`, {
        onSuccess: () => {
            form.reset(), toast.warning("Usuário editado com sucesso!");
        },
    });
};
</script>

<script>
import { mask } from "vue-the-mask";

export default {
    directives: { mask },
};
</script>
