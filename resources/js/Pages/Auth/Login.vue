<template>
    <div
        class="flex flex-col justify-center items-center w-full h-screen bg-zinc-50"
    >
        <form @submit.prevent="submitLogin">
            <div class="flex flex-col mb-4">
                <label for="email" class="font-bold">Email</label>
                <input
                    class="p-3 text-lg w-96 border border-black rounded-sm"
                    type="text"
                    name="email"
                    id="email"
                    v-model="form.email"
                />
                <span
                    v-if="form.errors.email"
                    v-text="form.errors.email"
                    class="text-rose-400 text-xs mt-1"
                ></span>
            </div>

            <div class="flex flex-col mb-4">
                <label for="password" class="font-bold">Senha</label>
                <input
                    class="p-3 text-lg w-96 border border-black rounded-sm"
                    type="password"
                    name="password"
                    id="password"
                    v-model="form.password"
                />
                <span
                    v-if="form.errors.password"
                    v-text="form.errors.password"
                    class="text-rose-400 text-xs mt-1"
                ></span>
            </div>
            <button
                type="submit"
                class="w-96 bg-white border border-black rounded-sm text-xl font-bold p-2 mt-4"
            >
                Entrar
            </button>
        </form>
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";

let form = useForm({
    email: "",
    password: "",
});

const submitLogin = () => {
    form.post("/login", form);
};
</script>
