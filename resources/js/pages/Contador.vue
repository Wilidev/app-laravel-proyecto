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
        title: 'Dashboard',
        href: dashboard().url,
    },
];
function incrementar(){
    contador.value++;

}
function decrementar(){
    contador.value--;
    
}
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
     <div class="flex flex-col items-center justify-center ">
  <p class="text-amber-600 text-9xl">Contador</p>
  <p> {{ contador }}</p>
  <button @click="incrementar" type="button">+</button>
  <button @click="decrementar" type="button">-</button>
</div>
    </AppLayout>
</template>

