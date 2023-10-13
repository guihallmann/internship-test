<template>
    <div
        class="grid grid-rows-6 space-y-0.5 items-center justify-items-start border-2 border-zinc-800 rounded m-1 p-4 bg-zinc-100 font-normal text-xl hover:bg-zinc-200/80 sm:grid-cols-6 sm:grid-rows-none"
    >
        <span><strong>CPF: </strong>{{ person.cpf }}</span>
        <span><strong>Nome: </strong>{{ person.name }}</span>
        <span><strong>Nascimento: </strong>{{ person.birthday }}</span>
        <span><strong>Sexo: </strong>{{ person.sex }}</span>
        <span
            ><strong>Endereço: </strong>
            {{
                [
                    person.street ? `${person.street}` : "",
                    person.number ? `nº ${person.number}` : "",
                    person.neighborhood ? `${person.neighborhood}` : "",
                    person.city ? `${person.city}` : "",
                ]
                    .filter(Boolean)
                    .join(", ")
            }}
        </span>
        <div class="flex justify-center items-center w-full gap-4">
            <nav-link
                class="font-medium text-amber-500 hover:underline"
                :href="route('edit-person', { id: person.id })"
                as="button"
            >
                Editar
            </nav-link>
            <nav-link
                class="font-medium text-rose-500 hover:underline"
                :href="route('delete-person', { id: person.id })"
                as="button"
                method="delete"
            >
                Excluir
            </nav-link>
        </div>
    </div>
</template>

<script>
import NavLink from "./NavLink.vue";
export default {
    components: { NavLink },
    props: {
        person: Object,
    },
};
</script>
