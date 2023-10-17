<template>
    <div>
        <button
            @click="isBurgerMenuOpen = !isBurgerMenuOpen"
            class="text-white text-xl font-bold"
        >
            ☰
        </button>
        <div
            v-if="isBurgerMenuOpen"
            class="absolute top-14 right-4 border-2 border-zinc-800 bg-zinc-100 rounded p-4 shadow-md space-y-4 justify-between items-center flex flex-col"
        >
            <nav-link
                class="flex justify-between items-center w-full gap-2 text-xl text-zinc-800 font-medium hover:underline"
                href="/person/all"
                :active="$page.component === 'Person/Index'"
            >
                Contribuintes
                <icon name="users" />
            </nav-link>
            <nav-link
                class="flex justify-between items-center w-full gap-2 text-xl text-zinc-800 font-medium hover:underline"
                href="/protocol/all"
                :active="$page.component === 'Protocol/Index'"
            >
                Protocolos
                <icon name="prots" />
            </nav-link>
            <nav-link
                class="flex justify-between items-center w-full gap-2 text-xl text-zinc-800 font-medium hover:underline"
                href="/user/all"
                :active="$page.component === 'User/Index'"
            >
                Usuários
                <icon name="users" />
            </nav-link>
            <nav-link
                class="flex justify-between items-center w-full gap-2 text-xl text-zinc-800 font-medium hover:underline"
                href="/logout"
                method="post"
                as="button"
            >
                Sair
                <icon name="logout" />
            </nav-link>
        </div>
    </div>
</template>

<script setup>
import NavLink from "./NavLink.vue";
import Icon from "./Icon.vue";
import { ref } from "vue";

const isBurgerMenuOpen = ref(false);
</script>
