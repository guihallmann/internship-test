<template>
    <div class="flex justify-center bg-zinc-50 p-4 mt-4">
        <div
            class="w-full p-8 border-2 border-black rounded shadow-xl sm:max-w-3xl"
        >
            <div class="mb-4">
                <h1 class="text-2xl font-bold text-zinc-800">
                    Cadastrar Contribuinte
                </h1>
                <hr class="flex-grow" />
            </div>
            <form @submit.prevent="submitPerson">
                <div class="flex flex-col mb-4">
                    <label for="name" class="block text-sm font-bold">
                        Nome
                    </label>
                    <input
                        class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100"
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Nome completo"
                        v-model="form.name"
                    />
                </div>

                <div class="flex flex-col mb-4">
                    <label for="birthday" class="block text-sm font-bold">
                        Data de nascimento
                    </label>
                    <input
                        class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100"
                        type="date"
                        name="birthday"
                        id="birthday"
                        v-model="form.birthday"
                    />
                </div>

                <div class="flex flex-col mb-4">
                    <label for="cpf" class="block text-sm font-bold">
                        CPF
                    </label>
                    <input
                        class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100"
                        type="text"
                        name="cpf"
                        id="cpf"
                        placeholder="CPF"
                        v-model="form.cpf"
                    />
                </div>

                <div class="flex flex-col mb-4">
                    <label for="sex" class="block text-sm font-bold">
                        Sexo
                    </label>
                    <select
                        name="sex"
                        id="sex"
                        v-model="form.sex"
                        class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100"
                    >
                        <option value="">Sexo</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>

                <div class="flex flex-col mb-4">
                    <label for="city" class="block text-sm font-bold">
                        Cidade
                    </label>
                    <input
                        class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100"
                        type="text"
                        name="city"
                        id="city"
                        placeholder="Cidade"
                        v-model="form.city"
                    />
                </div>

                <div class="flex flex-col mb-4">
                    <label for="street" class="block text-sm font-bold">
                        Rua
                    </label>
                    <input
                        class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100"
                        type="text"
                        name="street"
                        id="street"
                        placeholder="Rua"
                        v-model="form.street"
                    />
                </div>

                <div class="flex flex-col mb-4">
                    <label for="number" class="block text-sm font-bold">
                        Número
                    </label>
                    <input
                        class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100"
                        type="number"
                        name="number"
                        id="number"
                        placeholder="Número"
                        v-model="form.number"
                    />
                </div>

                <div class="flex flex-col mb-4">
                    <label for="neighborhood" class="block text-sm font-bold">
                        Bairro
                    </label>
                    <input
                        class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100"
                        type="text"
                        name="neighborhood"
                        id="neighborhood"
                        placeholder="Bairro"
                        v-model="form.neighborhood"
                    />
                </div>

                <div class="flex flex-col mb-4">
                    <label for="complement" class="block text-sm font-bold">
                        Complemento
                    </label>
                    <input
                        class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100"
                        type="text"
                        name="complement"
                        id="complement"
                        placeholder="Complemento"
                        v-model="form.complement"
                    />
                </div>

                <button
                    type="submit"
                    class="w-full border-2 border-zinc-800 rounded-sm text-xl font-bold p-2 mt-4 bg-green-400 hover:bg-green-400/90"
                >
                    Cadastrar
                </button>
            </form>
        </div>
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";

let form = useForm({
    name: "",
    birthday: "",
    cpf: "",
    sex: "",
    city: "",
    neighborhood: "",
    street: "",
    number: "",
    complement: "",
});

const submitPerson = () => {
    form.post("/person", form);
};
</script>
