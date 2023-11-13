<template>
    <layout>
        <div
            class="flex flex-col text-lg m-4 p-4 border-2 border-black rounded shadow-xl sm:space-x-4"
        >
            <div class="flex flex-col space-y-4">
                <h1 class="text-2xl font-bold">Registro</h1>
                <hr class="my-2 mr-2" />
                <p><strong>ID Auditoria:</strong> {{ audit.id }}</p>
                <p><strong>Ação:</strong> {{ audit.event }}</p>
                <p><strong>Tabela:</strong> {{ audit.auditable_type }}</p>
                <p><strong>ID Registro:</strong> {{ audit.auditable_id }}</p>
                <p class="break-all">
                    <strong>Valores antigos:</strong> {{ audit.old_values }}
                </p>
                <p class="break-all">
                    <strong>Valores novos:</strong> {{ audit.new_values }}
                </p>
                <p><strong>URL:</strong> {{ audit.url }}</p>
                <p><strong>IP:</strong> {{ audit.ip_address }}</p>
                <p>
                    <strong>Registrado:</strong>
                    {{ formatDate(audit.created_at) }}
                </p>
                <p><strong>ID Usuário:</strong> {{ audit.user.id }}</p>
                <p><strong>Tabela:</strong> {{ audit.user_type }}</p>
                <p><strong>Nome:</strong> {{ audit.user.name }}</p>
                <p><strong>CPF:</strong> {{ formatCpf(audit.user.cpf) }}</p>
                <p><strong>Email:</strong> {{ audit.user.email }}</p>
                <p>
                    <strong>Cargo:</strong> {{ audit.user.role.toUpperCase() }}
                </p>
            </div>
        </div>
    </layout>
</template>
<script setup>
import Layout from "../Shared/Layout.vue";
import { formatDate } from "../../utils/date";
import { formatCpf } from "../../utils/cpf";

const props = defineProps({
    audit: Object,
});
</script>
