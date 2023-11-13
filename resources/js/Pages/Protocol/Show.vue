<template>
    <Layout>
        <section class="flex flex-col">
            <div
                class="flex flex-col text-lg m-4 p-4 border-2 border-black rounded shadow-xl"
            >
                <h1 class="text-2xl font-bold mb-4">Detalhes Protocolo</h1>
                <div class="grid grid-cols-3 space-x-10">
                    <div class="flex flex-col space-y-4">
                        <h1 class="text-xl font-medium">Protocolo</h1>
                        <hr class="my-2 mr-2" />
                        <p><strong>ID Protocolo:</strong> {{ protocol.id }}</p>
                        <p class="break-all">
                            <strong>Descrição:</strong>
                            {{ protocol.description }}
                        </p>
                        <p>
                            <strong>Prazo:</strong>
                            {{
                                expireDate(
                                    new Date(protocol.created_at),
                                    protocol.deadline
                                )
                            }}
                        </p>
                        <p>
                            <strong>Cadastrado:</strong>
                            {{ formatDate(protocol.created_at) }}
                        </p>
                    </div>
                    <div class="flex flex-col space-y-4">
                        <h1 class="text-xl font-medium">Contribuinte</h1>
                        <hr class="my-2 mr-2" />
                        <p>
                            <strong>ID Contribuinte:</strong>
                            {{ protocol.person.id }}
                        </p>
                        <p>
                            <strong>Contribuinte:</strong>
                            {{ protocol.person.name }}
                        </p>
                        <p>
                            <strong>CPF:</strong>
                            {{ formatCpf(protocol.person.cpf) }}
                        </p>
                    </div>
                    <div class="flex flex-col space-y-4">
                        <h1 class="text-xl font-medium">Departamento</h1>
                        <hr class="my-2 mr-2" />
                        <p>
                            <strong>ID Departamento:</strong>
                            {{ protocol.department.id }}
                        </p>
                        <p>
                            <strong>Departamento:</strong>
                            {{ protocol.department.name }}
                        </p>
                    </div>
                </div>
            </div>
            <div
                v-if="protocol.follow_up.length"
                class="flex flex-col text-lg m-4 p-4 border-2 border-black rounded shadow-xl"
            >
                <h1 class="text-2xl font-bold mb-2">Acompanhamentos</h1>
                <hr class="my-2 mr-2" />
                <div
                    v-for="followUp in protocol.follow_up"
                    class="grid grid-cols-5 space-x-4 p-2"
                >
                    <p><strong>ID Acompanhamento:</strong> {{ followUp.id }}</p>
                    <p class="break-all">
                        <strong>Observação:</strong> {{ followUp.observation }}
                    </p>
                    <p>
                        <strong>Cadastrado:</strong>
                        {{ formatDate(followUp.created_at) }}
                    </p>
                    <p><strong>ID Usuário:</strong> {{ followUp.user_id }}</p>
                    <button
                        class="font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600 shadow-md"
                        type="button"
                        @click="confirmRemove(followUp.id)"
                    >
                        Remover
                    </button>
                </div>
            </div>

            <div
                v-if="protocol.attachments.length"
                class="flex flex-col text-lg m-4 p-4 border-2 border-black rounded shadow-xl"
            >
                <h1 class="text-2xl font-bold mb-2">Anexos</h1>
                <hr class="my-2 mr-2" />
                <div
                    v-for="attachment in protocol.attachments"
                    class="grid grid-cols-4 space-x-4 p-2"
                >
                    <p class="break-all">
                        <strong>Arquivo:</strong> {{ attachment.name }}
                    </p>
                    <p>
                        <strong>Anexado:</strong>
                        {{ formatDate(attachment.created_at) }}
                    </p>
                    <!-- <button
                        class="font-medium bg-cyan-500 p-2 rounded-sm text-white hover:bg-cyan-600 shadow-md"
                        type="button"
                        @click="downloadAttachment(attachment.id)"
                    >
                        Baixar
                    </button> -->
                    <a
                        :href="'/protocol/download/' + attachment.id"
                        class="flex justify-center items-center gap-4 font-medium bg-cyan-500 p-2 rounded-sm text-white hover:bg-cyan-600 shadow-md"
                    >
                        Baixar
                        <icon name="download" />
                    </a>
                    <button
                        class="font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600 shadow-md"
                        type="button"
                        @click="destroyAttachment(attachment.id)"
                    >
                        Excluir
                    </button>
                </div>
            </div>
        </section>
    </Layout>
    <delete-modal
        :remove-button="true"
        :active="showModal"
        @cancel="showModal = false"
        @remove="removeFollowUp(selectedFollowUp)"
    />
</template>
<script setup>
import Layout from "../Shared/Layout.vue";
import DeleteModal from "../Shared/DeleteModal.vue";
import Icon from "../Shared/Icon.vue";
import { expireDate, formatDate } from "../../utils/date";
import { formatCpf } from "../../utils/cpf";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const showModal = ref(false);

const selectedFollowUp = ref(null);

const props = defineProps({
    protocol: Object,
});

const downloadAttachment = (id) => {
    router.get(route("download-attachment", id));
};

const destroyAttachment = (id) => {
    router.delete(route("destroy-attachment", id));
};

const confirmRemove = (id) => {
    selectedFollowUp.value = id;
    showModal.value = true;
};

const removeFollowUp = (id) => {
    router.delete(route("destroy-followUp", id), {
        onSuccess: () => {
            toast.error("Acompanhamento removido do protocolo com sucesso!");
        },
    });
    showModal.value = false;
};
</script>
