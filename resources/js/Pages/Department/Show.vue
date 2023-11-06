<template>
    <Layout>
        <div class="p-4">
            <span class="font-bold text-3xl">
                Departamento {{ departmentUsers.name }}
            </span>
            <hr class="flex-grow my-3" />

            <add-user :department-id="departmentUsers.id" :users="users" />
        </div>
        <div class="p-4">
            <span class="font-bold text-3xl"> Lista de Usuários </span>
            <hr class="flex-grow my-3" />
            <div class="container mt-4 mx-auto">
                <div class="flex justify-center mb-2">
                    <button
                        class="font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600 shadow-md"
                        type="button"
                        @click="shouldOpenModal"
                    >
                        Remover
                    </button>
                </div>
                <DataTable
                    id="datatable"
                    :data="departmentUsers.users"
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
                            <th>Cadastrado</th>
                        </tr>
                    </thead>
                </DataTable>
            </div>
        </div>
    </Layout>
    <delete-modal
        :remove-button="true"
        :active="showModal"
        @cancel="showModal = false"
        @remove="removeUser"
    />
</template>
<script setup>
import Layout from "../Shared/Layout.vue";
import AddUser from "./AddUser.vue";
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net";
import "datatables.net-select";
import "datatables.net-responsive";
import DeleteModal from "../Shared/DeleteModal.vue";
import { ref, onMounted } from "vue";
import { formatDate } from "../../utils/date";
import { formatCpf } from "../../utils/cpf";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const showModal = ref(false);

const props = defineProps({
    departmentUsers: Object,
    users: Array,
});

DataTable.use(DataTablesCore);

let dt;

const table = ref();

onMounted(function () {
    dt = table.value.dt;
});

const columns = [
    { data: "name" },
    { data: "email" },
    { data: null, render: (data) => formatCpf(data.cpf) },
    { data: null, render: (data) => data.role.toUpperCase() },
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

const getSelectedRow = () => {
    const row = dt.row({ selected: true }).data();
    if (row) return row;
    else return null;
};

const shouldOpenModal = () => {
    const isRowSelected = getSelectedRow();
    if (isRowSelected) {
        showModal.value = true;
    } else {
        toast.error("Selecione um usuário!");
    }
};

const removeUser = () => {
    const rowData = getSelectedRow();
    router.delete(
        route("remove-user-from-department", {
            user_id: rowData.pivot.user_id,
            department_id: rowData.pivot.department_id,
        }),
        {
            onSuccess: () => {
                toast.error("Usuário removido do departamento com sucesso!");
            },
        }
    );
    showModal.value = false;
};
</script>
