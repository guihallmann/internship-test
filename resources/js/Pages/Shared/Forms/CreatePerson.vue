<template>
    <div class="flex w-full justify-center bg-zinc-50 p-4 mt-4 sm:mx-4">
        <div
            class="w-full mx-auto p-8 border-2 border-black rounded shadow-xl sm:max-w-full"
        >
            <div class="mb-4">
                <h1 class="text-2xl font-bold text-zinc-800">
                    Cadastrar Contribuinte
                </h1>
                <hr class="flex-grow" />
            </div>
            <form @submit.prevent="submitPerson">
                <div class="flex flex-col sm:grid grid-cols-3 gap-4">
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
                            @change="form.validate('name')"
                        />
                        <span
                            v-if="form.errors.name"
                            v-text="form.errors.name"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>

                    <div class="flex flex-col mb-4">
                        <label for="birthday" class="block text-sm font-bold">
                            Data de nascimento
                        </label>
                        <input
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            type="date"
                            name="birthday"
                            id="birthday"
                            v-model="form.birthday"
                            @change="form.validate('birthday')"
                        />
                        <span
                            v-if="form.errors.birthday"
                            v-text="form.errors.birthday"
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
                            @change="form.validate('cpf')"
                        />
                        <span
                            v-if="form.errors.cpf"
                            v-text="form.errors.cpf"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>

                    <div class="flex flex-col mb-4">
                        <label for="sex" class="block text-sm font-bold">
                            Sexo
                        </label>
                        <select
                            name="sex"
                            id="sex"
                            v-model="form.sex"
                            @change="form.validate('sex')"
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                        >
                            <option value="">Sexo</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>
                        <span
                            v-if="form.errors.sex"
                            v-text="form.errors.sex"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>

                    <div class="flex flex-col mb-4">
                        <label for="city" class="block text-sm font-bold">
                            Cidade
                        </label>
                        <input
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            type="text"
                            name="city"
                            id="city"
                            placeholder="Cidade"
                            v-model="form.city"
                        />
                        <span
                            v-if="form.errors.city"
                            v-text="form.errors.city"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>

                    <div class="flex flex-col mb-4">
                        <label for="street" class="block text-sm font-bold">
                            Rua
                        </label>
                        <input
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            type="text"
                            name="street"
                            id="street"
                            placeholder="Rua"
                            v-model="form.street"
                        />
                        <span
                            v-if="form.errors.street"
                            v-text="form.errors.street"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>

                    <div class="flex flex-col mb-4">
                        <label for="number" class="block text-sm font-bold">
                            Número
                        </label>
                        <input
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            type="text"
                            name="number"
                            id="number"
                            placeholder="Número"
                            v-model="form.number"
                        />
                        <span
                            v-if="form.errors.number"
                            v-text="form.errors.number"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>

                    <div class="flex flex-col mb-4">
                        <label
                            for="neighborhood"
                            class="block text-sm font-bold"
                        >
                            Bairro
                        </label>
                        <input
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            type="text"
                            name="neighborhood"
                            id="neighborhood"
                            placeholder="Bairro"
                            v-model="form.neighborhood"
                        />
                        <span
                            v-if="form.errors.neighborhood"
                            v-text="form.errors.neighborhood"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>

                    <div class="flex flex-col mb-4">
                        <label for="complement" class="block text-sm font-bold">
                            Complemento
                        </label>
                        <input
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            type="text"
                            name="complement"
                            id="complement"
                            placeholder="Complemento"
                            v-model="form.complement"
                        />
                        <span
                            v-if="form.errors.complement"
                            v-text="form.errors.complement"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full border-2 border-zinc-800 rounded-sm text-xl font-bold p-2 mt-4 bg-emerald-400 hover:bg-emerald-400/80 sm:w-1/4"
                    >
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { useForm } from "laravel-precognition-vue-inertia";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const form = useForm("post", route("store-person"), {
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
    form.submit({
        onSuccess: () => {
            form.reset(), toast.success("Contribuinte cadastrado com sucesso!");
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
