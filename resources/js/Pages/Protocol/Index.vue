<template>
    <layout>
        <div class="container mt-4 mx-auto">
            <div
                class="flex flex-col gap-2 justify-between items-center my-2 py-4 sm:flex-row"
            >
                <div class="flex gap-1">
                    <report-download-button :url="'/protocol/report'" />
                    <details-button :details-function="showProtocolDetails" />
                </div>
                <div class="flex gap-1">
                    <edit-button :edit-function="editProtocol" />
                    <delete-button :delete-function="shouldOpenModal" />
                    <new-button :url="'/protocol/create'" />
                </div>
            </div>
            <DataTable
                id="datatable"
                :data="protocols"
                :columns="columns"
                :options="options"
                ref="table"
                class="display nowrap"
                width="100%"
            >
                <thead class="bg-gray-200">
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Prazo</th>
                        <th>Cadastrado</th>
                        <th>Departamento</th>
                        <th>Contribuinte</th>
                        <th>CPF</th>
                    </tr>
                </thead>
            </DataTable>
        </div>
    </layout>
    <delete-modal
        :active="showModal"
        @cancel="showModal = false"
        @delete="destroyProtocol"
    />
</template>
<script setup>
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net";
import "datatables.net-select";
import "datatables.net-responsive";
import Layout from "../Shared/Layout.vue";
import DetailsButton from "../Shared/Buttons/DetailsButton.vue";
import ReportDownloadButton from "../Shared/Buttons/ReportDownloadButton.vue";
import DeleteButton from "../Shared/Buttons/DeleteButton.vue";
import EditButton from "../Shared/Buttons/EditButton.vue";
import NewButton from "../Shared/Buttons/NewButton.vue";
import DeleteModal from "../Shared/DeleteModal.vue";
import { ref, onMounted } from "vue";
import { expireDate, formatDate } from "../../utils/date";
import { formatCpf } from "../../utils/cpf";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

DataTable.use(DataTablesCore);

const props = defineProps({
    protocols: Array,
});

const toast = useToast();

const showModal = ref(false);

let dt;

const table = ref();

onMounted(function () {
    dt = table.value.dt;
});

const columns = [
    { data: "id" },
    { data: "description" },
    {
        data: null,
        render: (data) => expireDate(new Date(data.created_at), data.deadline),
    },
    { data: null, render: (data) => formatDate(data.created_at) },
    { data: null, render: (data) => data.department.name },
    { data: null, render: (data) => data.person.name },
    { data: null, render: (data) => formatCpf(data.person.cpf) },
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

const editProtocol = () => {
    const id = getSelectedRowId();
    if (!id) toast.warning("Selecione um protocolo!");
    else router.get(route("edit-protocol", id));
};

const destroyProtocol = () => {
    const id = getSelectedRowId();
    router.delete(route("destroy-protocol", id), {
        onSuccess: () => {
            toast.error("Protocolo excluído com sucesso!");
            showModal.value = false;
        },
    });
};

const showProtocolDetails = () => {
    const id = getSelectedRowId();
    if (!id) toast.warning("Selecione um protocolo!");
    else router.get(route("show-protocol", id));
};

const shouldOpenModal = () => {
    const isRowSelected = getSelectedRowId();
    if (isRowSelected) {
        showModal.value = true;
    } else {
        toast.error("Selecione um protocolo!");
    }
};

const downloadProtocolsReport = () => {
    router.get(route("download-protocols-report"));
};
</script>
