<template>
    <div class="flex justify-center items-center min-h-screen bg-zinc-50">
        <div
            class="w-full max-w-lg p-8 border-2 border-black rounded shadow-xl"
        >
            <form @submit.prevent="submitLogin">
                <div class="flex flex-col mb-4">
                    <label for="email" class="block text-sm font-bold"
                        >Email</label
                    >
                    <input
                        class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100"
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
                    <label for="password" class="block text-sm font-bold"
                        >Senha</label
                    >
                    <input
                        class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100"
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Senha"
                        v-model="form.password"
                    />
                    <span
                        v-if="form.errors.password"
                        v-text="form.errors.password"
                        class="text-rose-500 text-xs mt-1 font-medium"
                    ></span>
                </div>
                <button
                    type="submit"
                    class="w-full border-2 border-zinc-800 rounded-sm text-xl font-bold p-2 mt-4 bg-zinc-100 hover:bg-zinc-200"
                >
                    Entrar
                </button>
            </form>
        </div>
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
