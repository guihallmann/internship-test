<template>
    <div>
        <div
            v-if="active"
            class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm"
        >
            <div
                class="bg-white rounded-lg p-8 shadow-lg w-80 border-black border-2 sm:w-96"
            >
                <h2 class="text-lg font-bold mb-4">Confirmar exclusão</h2>
                <p class="text-zinc-600 mb-4">
                    Tem certeza que deseja excluir este registro?
                </p>
                <div class="flex justify-end space-x-3">
                    <button
                        @click="cancel"
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded shadow-md"
                    >
                        Cancelar
                    </button>
                    <button
                        v-if="!removeButton"
                        @click="confirmDelete"
                        class="px-4 py-2 bg-rose-500 hover-bg-rose-600 text-white rounded shadow-md"
                    >
                        Excluir
                    </button>
                    <button
                        v-if="removeButton"
                        @click="confirmRemove"
                        class="px-4 py-2 bg-rose-500 hover-bg-rose-600 text-white rounded shadow-md"
                    >
                        Remover
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    active: Boolean,
    removeButton: Boolean,
});

const emit = defineEmits(["cancel", "delete", "remove"]);

const cancel = () => {
    emit("cancel");
};

const confirmDelete = () => {
    emit("delete");
};

const confirmRemove = () => {
    emit("remove");
};
</script>
