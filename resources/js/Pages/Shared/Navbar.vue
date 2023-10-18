<template>
    <nav
        class="flex w-full justify-between items-center bg-zinc-800 p-4 shadow-md"
    >
        <nav-link class="text-white text-3xl font-bold" href="/"
            >I.T.S</nav-link
        >
        <div class="hidden sm:flex space-x-8">
            <nav-link
                class="flex justify-between items-center w-full gap-2 text-xl text-white font-medium hover:underline"
                href="/person/all"
                :active="$page.component === 'Person/Index'"
            >
                Contribuintes
                <icon name="users" />
            </nav-link>
            <nav-link
                class="flex justify-between items-center w-full gap-2 text-xl text-white font-medium hover:underline"
                href="/protocol/all"
                :active="$page.component === 'Protocol/Index'"
            >
                Protocolos
                <icon name="prots" />
            </nav-link>
            <nav-link
                v-if="role === 'Ti' || role === 'Sys'"
                class="flex justify-between items-center w-full gap-2 text-xl text-white font-medium hover:underline"
                href="/user/all"
                :active="$page.component === 'User/Index'"
            >
                Usuários
                <icon name="users" />
            </nav-link>
            <nav-link
                v-if="role === 'Ti' || role === 'Sys'"
                class="flex justify-between items-center w-full gap-2 text-xl text-white font-medium hover:underline"
                href="/department/all"
                :active="$page.component === 'Department/Index'"
            >
                Departamentos
                <icon name="deps" />
            </nav-link>
        </div>

        <nav-link
            class="hidden sm:flex items-center justify-center gap-2 text-xl text-white font-medium hover:underline"
            href="/logout"
            method="post"
            as="button"
        >
            Sair
            <icon name="logout" />
        </nav-link>
        <div class="sm:hidden">
            <burguer />
        </div>
    </nav>
</template>

<script setup>
import NavLink from "./NavLink.vue";
import Icon from "./Icon.vue";
import Burguer from "./Burguer.vue";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const role = computed(() => page.props.auth.user.role);
</script>
