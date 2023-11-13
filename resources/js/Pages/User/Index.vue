<template>
    <layout>
        <div class="container mt-4 mx-auto">
            <div
                class="flex justify-center items-center my-2 py-4 gap-1 sm:justify-end"
            >
                <edit-button :edit-function="editUser" />
                <delete-button :delete-function="shouldOpenModal" />
                <new-button :url="'/user/create'" />
            </div>
            <DataTable
                id="datatable"
                :data="users"
                :columns="columns"
                :options="options"
                ref="table"
                class="display nowrap"
                width="100%"
            >
                <thead class="bg-gray-200">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Cargo</th>
                        <th>Cadastro</th>
                    </tr>
                </thead>
            </DataTable>
        </div>
    </layout>
    <delete-modal
        :active="showModal"
        @cancel="showModal = false"
        @delete="destroyUser"
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
import { ref, onMounted } from "vue";
import { formatDate } from "../../utils/date";
import { formatCpf } from "../../utils/cpf";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

DataTable.use(DataTablesCore);

const props = defineProps({
    users: Array,
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
    { data: "email" },
    { data: null, render: (data) => formatCpf(data.cpf) },
    { data: "role" },
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

const editUser = () => {
    const id = getSelectedRowId();
    if (!id) toast.warning("Selecione um usuário!");
    else router.get(route("edit-user", id));
};

const destroyUser = () => {
    const id = getSelectedRowId();
    router.delete(route("destroy-user", id), {
        onSuccess: () => {
            toast.error("Usuário excluído com sucesso!");
            showModal.value = false;
        },
    });
};

const shouldOpenModal = () => {
    const isRowSelected = getSelectedRowId();
    if (isRowSelected) {
        showModal.value = true;
    } else {
        toast.error("Selecione um usuário!");
    }
};
</script>
