<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { categoria, dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';

const categorias = ref([]);
const miNombre = ref("");

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Categoria',
        href: dashboard().url,
    },
];

const listarCategoria = async () => {

    try {
        const respuesta = await axios.get('/categorias-data');
        console.log(respuesta);
        if (respuesta.data.success) {
            categorias.value = respuesta.data.data;
            miNombre.value = respuesta.data.nombre;
        }
    } catch (error: any) {

    }
}
onMounted(listarCategoria);
</script>

<template>

    <Head title="Gestion Categoria" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex items-center justify-center">
            <div>
                <p class="text-amber-600 text-2xl">Gestion Categoria 🍀</p>
                <small>{{ miNombre }}</small>
            </div>
        </div>
        <div class="overflow-x-auto rounded border border-gray-300 shadow-sm dark:border-gray-600">
            <table class="min-w-full divide-y-2 divide-gray-200 dark:divide-gray-700">
                <thead class="ltr:text-left rtl:text-right">
                    <tr class="*:font-medium *:text-gray-900 dark:*:text-white">
                        <th class="px-3 py-2 whitespace-nowrap">Nombre</th>
                        <th class="px-3 py-2 whitespace-nowrap">Descripcion</th>
                        <th class="px-3 py-2 whitespace-nowrap">Estado</th>
                        <th class="px-3 py-2 whitespace-nowrap">Opciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <tr v-for="item in categorias" :key="item.id"
                        class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                        <td class="px-3 py-2 whitespace-nowrap">{{ item.nombre_categoria }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ item.descripcion }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ item.estado }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
