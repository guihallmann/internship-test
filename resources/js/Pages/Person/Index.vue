<template>
    <layout>
        <div class="container mt-4 mx-auto">
            <div class="flex justify-center space-x-4 my-2">
                <button
                    class="font-medium p-2 rounded-sm text-white shadow-md bg-amber-500 hover:bg-amber-600"
                    type="button"
                    @click="editPerson"
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
            </div>
            <DataTable
                id="datatable"
                :data="people"
                :columns="columns"
                :options="options"
                ref="table"
                class="display nowrap"
                width="100%"
            >
                <thead class="bg-gray-200">
                    <tr>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Nascimento</th>
                        <th>Sexo</th>
                        <th>Endereço</th>
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
import { ref, onMounted } from "vue";
import { formatDate } from "../../utils/date";
import { formatCpf } from "../../utils/cpf";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";
import { formatAddress } from "../../utils/address";

DataTable.use(DataTablesCore);

const props = defineProps({
    people: Array,
});

const toast = useToast();

const showModal = ref(false);

let dt;

const table = ref();

onMounted(function () {
    dt = table.value.dt;
});

const columns = [
    { data: null, render: (data) => formatCpf(data.cpf) },
    { data: "name" },
    { data: null, render: (data) => formatDate(data.birthday) },
    { data: "sex" },
    { data: null, render: (data) => formatAddress(data) },
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

const editPerson = () => {
    const id = getSelectedRowId();
    if (!id) toast.warning("Selecione um contribuinte!");
    else router.get(route("edit-person", id));
};

const destroyUser = () => {
    const id = getSelectedRowId();
    router.delete(route("destroy-person", id), {
        onSuccess: () => {
            toast.error("Contribuinte excluído com sucesso!");
            showModal.value = false;
        },
    });
};

const shouldOpenModal = () => {
    const isRowSelected = getSelectedRowId();
    if (isRowSelected) {
        showModal.value = true;
    } else {
        toast.error("Selecione um contribuinte!");
    }
};
</script>
