<template>
    <layout>
        <div class="container mt-4 mx-auto">
            <div class="flex justify-center space-x-4 my-2">
                <button
                    class="font-medium bg-cyan-500 p-2 rounded-sm text-white hover:bg-cyan-600 shadow-md"
                    type="button"
                    @click="showAuditDetails"
                >
                    Detalhes
                </button>
            </div>
            <DataTable
                id="datatable"
                :data="audits"
                :columns="columns"
                :options="options"
                ref="table"
                class="display nowrap"
                width="100%"
            >
                <thead class="bg-gray-200">
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Ação</th>
                        <th>Tabela</th>
                        <th>ID Registro</th>
                        <th>Registrado</th>
                    </tr>
                </thead>
            </DataTable>
        </div>
    </layout>
</template>
<script setup>
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net";
import "datatables.net-select";
import "datatables.net-responsive";
import Layout from "../Shared/Layout.vue";
import { ref, onMounted } from "vue";
import { formatDate } from "../../utils/date";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

DataTable.use(DataTablesCore);

const props = defineProps({
    audits: Array,
});

const toast = useToast();

let dt;

const table = ref();

onMounted(function () {
    dt = table.value.dt;
});

const columns = [
    { data: "id" },
    { data: null, render: (data) => data.user.name },
    { data: "event" },
    { data: "auditable_type" },
    { data: "auditable_id" },
    { data: null, render: (data) => formatDate(data.created_at) },
];

const options = {
    autoWidth: true,
    responsive: true,
    select: "single",
    select: {
        info: false,
    },
    language: {
        paginate: {
            first: "Primeira",
            last: "Última",
            next: "Próxima",
            previous: "Anterior",
        },
        search: "Pesquisar",
        emptyTable: "Sem dados disponíveis",
        zeroRecords: "Nenhum resultado encontrado",
        info: "Mostrando de _START_ a _END_ de _TOTAL_ registros",
        infoEmpty: "Mostrando 0 de 0 registros",
        infoFiltered: "(filtrados do total de _MAX_ registros)",
        lengthMenu: "Mostrar: _MENU_",
    },
};

const getSelectedRowId = () => {
    const row = dt.row({ selected: true }).data();
    if (row) return row.id;
    else return null;
};

const showAuditDetails = () => {
    const id = getSelectedRowId();
    if (!id) toast.warning("Selecione uma auditoria!");
    else router.get(route("show-audit", id));
};
</script>
