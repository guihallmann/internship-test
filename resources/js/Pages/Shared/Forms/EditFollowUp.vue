<template>
    <div class="flex w-full justify-center bg-zinc-50 p-4 mt-4 sm:mx-4">
        <div
            class="w-full mx-auto p-8 border-2 border-black rounded shadow-xl sm:max-w-full"
        >
            <div class="mb-4">
                <h1 class="text-2xl font-bold text-zinc-800">
                    Editar Acompanhamento
                </h1>
                <hr class="flex-grow" />
            </div>
            <form @submit.prevent="editFollowUp">
                <div class="flex flex-col">
                    <div class="flex flex-col mb-4">
                        <label
                            for="observation"
                            class="block text-sm font-bold"
                        >
                            Observação
                        </label>
                        <textarea
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                            type=""
                            name="observation"
                            id="observation"
                            placeholder="Observação"
                            v-model="form.observation"
                        />
                        <span
                            v-if="form.errors.observation"
                            v-text="form.errors.observation"
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
                        Salvar
                    </button>
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
    followUp: Object,
});

let form = useForm({
    observation: props.followUp.observation,
});

const editFollowUp = () => {
    form.put(`/follow-up/edit/${props.followUp.id}`, {
        onSuccess: () => {
            form.reset(), toast.warning("Acompanhamento editado com sucesso!");
        },
    });
};
</script>
