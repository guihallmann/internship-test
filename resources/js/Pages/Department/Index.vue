<template>
    <layout>
        <div class="container mt-4 mx-auto">
            <div class="flex justify-center space-x-4 my-2">
                <button
                    class="font-medium bg-cyan-500 p-2 rounded-sm text-white hover:bg-cyan-600 shadow-md"
                    type="button"
                    @click="showDepartmentDetails"
                >
                    Detalhes
                </button>
                <button
                    class="font-medium p-2 rounded-sm text-white shadow-md bg-amber-500 hover:bg-amber-600"
                    type="button"
                    @click="editDepartment"
                >
                    Editar
                </button>
                <button
                    class="font-medium bg-rose-500 p-2 rounded-sm text-white hover:bg-rose-600 shadow-md"
                    type="button"
                    @click="shouldOpenModal"
                >
                    Excluir
                </button>
                <Link
                    class="text-center font-medium bg-emerald-500 p-2 rounded-sm text-white hover:bg-emerald-600 shadow-md"
                    href="/department/create"
                >
                    Novo
                </Link>
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
