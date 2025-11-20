<script setup lang="ts">
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
// Contador reactivo    
const count = ref(0);

// Función para incrementar
const incrementar = () => {
  count.value++;
};

</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
     <div class="flex flex-col items-center justify-center h-screen" @click="incrementar">
  <p class="text-amber-600 text-9xl">{{ count }}</p>
  <p class="text-gray-700 text-2xl mt-4">Contador</p>
</div>
    </AppLayout>
</template>

