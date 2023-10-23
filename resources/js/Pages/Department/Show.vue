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
            <div class="flex flex-col">
                <card
                    v-for="user in props.departmentUsers.users"
                    :key="user.id"
                    :user="user"
                    :remove-button="true"
                />
            </div>
            <no-results :size="departmentUsers.users.length" />
        </div>
    </Layout>
</template>
<script setup>
import Layout from "../Shared/Layout.vue";
import AddUser from "./AddUser.vue";
import Card from "../User/Card.vue";
import NoResults from "../Shared/NoResults.vue";

const props = defineProps({
    departmentUsers: Object,
    users: Array,
});
</script>
