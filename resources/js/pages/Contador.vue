<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { ref } from 'vue';

const contador = ref(0);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Wiliam Dida',
        href: dashboard().url,
    },
];
function incrementar() {
    contador.value++;

}
function decrementar() {
    contador.value--;

}
</script>

<template>

    <Head title="Dashboard" </Head>

        <AppLayout :breadcrumbs="breadcrumbs">
            <div class="flex flex-col items-center justify-center ">
                <p class="text-amber-600 text-9xl">🤣🤣Contador🤣🤣</p>
                <p class="text-blue-500 text-3xl">Wilam Dida</p>
                <p class=""> {{ contador }}</p>
                <div flex flex-wrap gap-4>
                    <button class=" bg-green-400 px-20 py-5 " @click="incrementar" type="button">+</button>
                    <button class=" bg-red-400 px-20 py-5" @click="decrementar" type="button">-</button>
                </div>
            </div>
        </AppLayout>
</template>
