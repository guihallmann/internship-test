<template>
    <Layout>
        <section class="flex flex-col">
            <div
                class="flex flex-col text-lg m-4 p-4 border-2 border-black rounded shadow-xl"
            >
                <div class="flex justify-between">
                    <h1 class="text-2xl font-bold mb-2">Detalhes Protocolo</h1>
                    <report-download-button
                        :url="'/protocol/report/' + protocol.id"
                    />
                </div>

                <div class="flex flex-col space-y-2">
                    <p><strong>ID Protocolo:</strong> {{ protocol.id }}</p>
                    <p class="break-all text-justify">
                        <strong>Descrição:</strong>
                        {{ protocol.description }}
                    </p>
                    <p>
                    <p>
                        <strong>Cadastrado:</strong>
                        {{ formatDate(protocol.created_at) }}
                    </p>
                        <strong>Prazo:</strong>
                        {{
                            expireDate(
                                new Date(protocol.created_at),
                                protocol.deadline
                            )
                        }}
                    </p>
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
            <div
                v-if="protocol.follow_up.length"
                class="flex flex-col text-lg m-4 p-4 border-2 border-black rounded shadow-xl"
            >
                <h1 class="text-2xl font-bold mb-2">Acompanhamentos</h1>
                <hr class="my-2 mr-2" />
                <div v-for="followUp in protocol.follow_up">
                    <div class="flex flex-col space-y-2 sm:grid grid-cols-6 sm:space-x-10">
                        <p class="col-span-1">
                            <strong>ID Acompanhamento:</strong> {{ followUp.id }}
                        </p>
                        <p class="col-span-2 break-all">
                            <strong>Observação:</strong> {{ followUp.observation }}
                        </p>
                        <p class="col-span-1">
                            <strong>Cadastrado:</strong>
                            {{ formatDate(followUp.created_at) }}
                        </p>
                        <p class="col-span-1">
                            <strong>ID Usuário:</strong> {{ followUp.user_id }}
                        </p>
                        <button
                            class="h-12 font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600 shadow-md col-span-1"
                            type="button"
                            @click="confirmRemove(followUp.id)"
                            >
                            Remover
                        </button>
                    </div>
                    <hr class="my-2 mr-2" />
                </div>
            </div>

            <div
                v-if="protocol.attachments.length"
                class="flex flex-col text-lg m-4 p-4 border-2 border-black rounded shadow-xl"
            >
                <h1 class="text-2xl font-bold mb-2">Anexos</h1>
                <hr class="my-2 mr-2" />
                <div v-for="attachment in protocol.attachments">
                    <div class="flex flex-col space-y-2 sm:grid grid-cols-6 sm:space-x-10">

                        <p class="break-all col-span-2">
                            <strong>Arquivo:</strong> {{ attachment.name }}
                        </p>
                        <p class="col-span-2">
                            <strong>Anexado:</strong>
                            {{ formatDate(attachment.created_at) }}
                        </p>
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
                    <hr class="my-2 mr-2" />
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
import ReportDownloadButton from "../Shared/Buttons/ReportDownloadButton.vue";
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
