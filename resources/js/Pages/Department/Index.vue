<template>
    <layout>
        <div class="container mt-4 mx-auto">
            <div
                class="flex flex-col gap-2 justify-between items-center my-2 py-4 sm:flex-row"
            >
                <div class="flex gap-1">
                    <details-button :details-function="showDepartmentDetails" />
                </div>
                <div class="flex gap-1">
                    <edit-button :edit-function="editDepartment" />
                    <delete-button :delete-function="shouldOpenModal" />
                    <new-button :url="'/department/create'" />
                </div>
            </div>
            <DataTable
                id="datatable"
                :data="departments"
                :columns="columns"
                :options="options"
                ref="table"
                class="display nowrap"
                width="100%"
            >
                <thead class="bg-gray-200">
                    <tr>
                        <th>Nome</th>
                        <th>Cadastrado</th>
                        <th>Usuários</th>
                        <th>Protocolos</th>
                    </tr>
                </thead>
            </DataTable>
        </div>
    </layout>
    <delete-modal
        :active="showModal"
        @cancel="showModal = false"
        @delete="destroyDepartment"
    />
</template>
<script setup>
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net";
import "datatables.net-select";
import "datatables.net-responsive";
import Layout from "../Shared/Layout.vue";
import DeleteModal from "../Shared/DeleteModal.vue";
import EditButton from "../Shared/Buttons/EditButton.vue";
import NewButton from "../Shared/Buttons/NewButton.vue";
import DeleteButton from "../Shared/Buttons/DeleteButton.vue";
import DetailsButton from "../Shared/Buttons/DetailsButton.vue";
import { ref, onMounted } from "vue";
import { formatDate } from "../../utils/date";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";
import { Link } from "@inertiajs/vue3";

DataTable.use(DataTablesCore);

const props = defineProps({
    departments: Array,
});

const toast = useToast();

const showModal = ref(false);

let dt;

const table = ref();

onMounted(function () {
    dt = table.value.dt;
});

const columns = [
    { data: "name" },
    { data: null, render: (data) => formatDate(data.created_at) },
    { data: null, render: (data) => data.users_count },
    { data: null, render: (data) => data.protocols_count },
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

const showDepartmentDetails = () => {
    const id = getSelectedRowId();
    if (!id) toast.warning("Selecione um departamento!");
    else router.get(route("show-department", id));
};

const editDepartment = () => {
    const id = getSelectedRowId();
    if (!id) toast.warning("Selecione um departamento!");
    else router.get(route("edit-department", id));
};

const destroyDepartment = () => {
    const id = getSelectedRowId();
    router.delete(route("destroy-department", id), {
        onSuccess: () => {
            toast.error("Departamento excluído com sucesso!");
            showModal.value = false;
        },
    });
};

const shouldOpenModal = () => {
    const isRowSelected = getSelectedRowId();
    if (isRowSelected) {
        showModal.value = true;
    } else {
        toast.error("Selecione um departamento!");
    }
};
</script>
