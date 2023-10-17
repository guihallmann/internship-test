<template>
    <div
        class="flex flex-col justify-center items-center min-h-screen bg-zinc-50 p-2"
    >
        <span class="font-extrabold text-5xl text-zinc-800 mb-6">I.T.S</span>
        <div
            class="w-full max-w-lg p-6 border-2 border-black rounded shadow-xl"
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
                    class="w-full border-2 border-zinc-800 rounded-sm text-xl font-bold p-2 my-4 bg-emerald-400 hover:bg-emerald-400/80"
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
