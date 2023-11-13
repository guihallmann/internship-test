<template>
    <layout>
        <div class="container mt-4 mx-auto">
            <div
                class="flex justify-center items-center my-2 py-4 gap-1 sm:justify-end"
            >
                <edit-button :edit-function="editFollowUp" />
                <delete-button :delete-function="shouldOpenModal" />
            </div>
            <DataTable
                id="datatable"
                :data="followUps"
                :columns="columns"
                :options="options"
                ref="table"
                class="display nowrap"
                width="100%"
            >
                <thead class="bg-gray-200">
                    <tr>
                        <th>ID</th>
                        <th>Observação</th>
                        <th>Prazo</th>
                        <th>Protocolo</th>
                        <th>Usuário</th>
                        <th>Cadastrado</th>
                    </tr>
                </thead>
            </DataTable>
        </div>
    </layout>
    <delete-modal
        :active="showModal"
        @cancel="showModal = false"
        @delete="destroyFollowUp"
    />
</template>
<script setup>
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net";
import "datatables.net-select";
import "datatables.net-responsive";
import Layout from "../Shared/Layout.vue";
import DeleteModal from "../Shared/DeleteModal.vue";
import DeleteButton from "../Shared/Buttons/DeleteButton.vue";
import EditButton from "../Shared/Buttons/EditButton.vue";
import { ref, onMounted } from "vue";
import { formatDate, expireDate } from "../../utils/date";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

DataTable.use(DataTablesCore);

const props = defineProps({
    followUps: Array,
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
    { data: "observation" },
    {
        data: null,
        render: (data) =>
            expireDate(
                new Date(data.protocol.created_at),
                data.protocol.deadline
            ),
    },
    { data: null, render: (data) => data.protocol.id },
    { data: null, render: (data) => data.user.name },
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

const editFollowUp = () => {
    const id = getSelectedRowId();
    if (!id) toast.warning("Selecione um acompanhamento!");
    else router.get(route("edit-followUp", id));
};

const destroyFollowUp = () => {
    const id = getSelectedRowId();
    router.delete(route("destroy-followUp", id), {
        onSuccess: () => {
            toast.error("Acompanhamento excluído com sucesso!");
            showModal.value = false;
        },
    });
};

const shouldOpenModal = () => {
    const isRowSelected = getSelectedRowId();
    if (isRowSelected) {
        showModal.value = true;
    } else {
        toast.error("Selecione um acompanhamento!");
    }
};
</script>
