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
                href="/people"
                :active="$page.component === 'People'"
            >
                Contribuintes
                <icon name="users" />
            </nav-link>
            <nav-link
                class="flex justify-between items-center w-full gap-2 text-xl text-white font-medium hover:underline"
                href="/protocols"
                :active="$page.component === 'Protocols'"
            >
                Protocolos
                <icon name="prots" />
            </nav-link>
            <nav-link
                class="flex justify-between items-center w-full gap-2 text-xl text-white font-medium hover:underline"
                href="/logout"
                method="post"
                as="button"
            >
                Sair
                <icon name="logout" />
            </nav-link>
        </div>

        <div class="sm:hidden">
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
                    href="/people"
                    :active="$page.component === 'People'"
                >
                    Contribuintes
                    <icon name="users" />
                </nav-link>
                <nav-link
                    class="flex justify-between items-center w-full gap-2 text-xl text-zinc-800 font-medium hover:underline"
                    href="#"
                    :active="$page.component === 'Protocols'"
                >
                    Protocolos
                    <icon name="prots" />
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
    </nav>
</template>

<script>
import NavLink from "./NavLink.vue";
import Icon from "./Icon.vue";

export default {
    components: { NavLink, Icon },
    data() {
        return {
            isBurgerMenuOpen: false,
        };
    },
};
</script>
