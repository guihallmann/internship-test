<template>
    <div class="flex w-full justify-center bg-zinc-50 p-4 mt-4 sm:mx-4">
        <div
            class="w-full mx-auto p-8 border-2 border-black rounded shadow-xl sm:max-w-full"
        >
            <div class="mb-4">
                <h1 class="text-2xl font-bold text-zinc-800">Anexar Arquivo</h1>
                <hr class="flex-grow" />
            </div>
            <form @submit.prevent="submitProtocol">
                <div class="flex flex-col">
                    <div>
                        <label for="files" class="block text-sm font-bold">
                            Anexar Arquivos (até 5 arquivos, máximo 3 MB cada)
                        </label>
                        <input
                            type="file"
                            name="files"
                            id="files"
                            multiple
                            @change="handleFileChange"
                            class="p-3 text-lg w-full border-2 border-zinc-800 rounded-sm bg-zinc-100 focus:bg-emerald-100/80"
                        />
                        <span
                            v-if="form.errors.files || form.errors['files.0']"
                            v-text="form.errors.files || form.errors['files.0']"
                            class="text-rose-500 text-xs mt-1 font-medium"
                        ></span>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button
                        type="submit"
                        :disabled="form.processing || form.files == ''"
                        class="w-full border-2 border-zinc-800 rounded-sm text-xl font-bold p-2 mt-4 bg-emerald-400 hover:bg-emerald-400/80 sm:w-1/4"
                    >
                        Anexar
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

const props = defineProps({
    protocol: Object,
});

const form = useForm("post", route("store-attachments", props.protocol.id), {
    files: "",
});

const submitProtocol = () => {
    form.submit({
        onSuccess: () => {
            form.reset(), toast.success("Arqvuivo anexado com sucesso!");
            form.files = "";
        },
    });
};

const handleFileChange = (event) => {
    form.files = event.target.files;
};
</script>
