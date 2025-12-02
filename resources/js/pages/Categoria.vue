<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { Pencil, Plus, SaveAll, SquareX, Trash2 } from 'lucide-vue-next';
import Swal from 'sweetalert2';

const categorias = ref([]);
const miNombre = ref("");
const mostrarModal = ref(false);
const mostrarModalEditar = ref(false);
const idCategoria = ref();
// Formulario
const formulario = ref(
    {
        nombre_categoria: '',
        descripcion: '',
    }
);

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
};

const abrirModal = () => {
    mostrarModal.value = true;
};

const cerrarModal = () => {
    mostrarModal.value = false;
};

//funciones para manipular el modal editar
const abrirModalEditar = (dataCategoria: any) => {
    mostrarModalEditar.value = true;
    idCategoria.value = dataCategoria.id;

    console.log(dataCategoria.nombre_categoria);
    console.log(dataCategoria.descripcion);

    formulario.value.nombre_categoria = dataCategoria.nombre_categoria;
    formulario.value.descripcion = dataCategoria.descripcion;

};

const cerrarModalEditar = () => {
    mostrarModalEditar.value = false;
    formulario.value = {
        nombre_categoria: '',
        descripcion: '',
    };
    idCategoria.value = null;

};

const enviarFormulario = async () => {
    console.log('Wiliam Dida');
    console.log(formulario.value);

    const respuesta = await axios.post('/categorias-data', formulario.value);
    if (respuesta.data.success) {
        Swal.fire({
            title: "Recurso creado",
            text: "Categoria creada",
            icon: "success"
        });
        mostrarModalEditar.value = false;
        listarCategoria();
    } else {
        Swal.fire({
            title: "Recurso no creado",
            text: "Categoria no creada",
            icon: "error"
        });
    }
    console.log(respuesta);
};

const actualizarFormulario = async () => {
    console.log('Wiliam Dida');
    console.log(formulario.value);

    const respuesta = await axios.put(`/categorias-data/${idCategoria.value}`, formulario.value);
    if (respuesta.data.success) {
        Swal.fire({
            title: 'Categoria editada con exito',
            text: 'Categoria editada',
            icon: 'success',
        }).then((result) => {
            if (result.isConfirmed) {
                mostrarModalEditar.value = false;
                listarCategoria();
            }
        });
    } else {
        Swal.fire({
            title: 'Error al editar',
            text: 'Categoria no editada',
            icon: 'error',
        });
    }
};
// const exportarPdf = () => {
// const
// }
const eliminarCategoria = async (id: number) => {
    const respuesta = await axios.delete(`/categorias-data/${id}`);
    console.log(respuesta);
    if (respuesta.data.success) {
        Swal.fire({
            title: "Recurso eliminado",
            text: "Categoria eliminada",
            icon: "success"
        });
    }
    listarCategoria();
}
const confirmacion = (id: number) => {
    Swal.fire({
        title: "Estas seguro?",
        text: `El recurso se eliminara de forma permanente: ID: ${id}`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminar"
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarCategoria(id);
        }
    });
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

        <div>
            <a class="group relative inline-flex items-center overflow-hidden rounded-sm border border-blue-600 px-8 py-3 text-white bg-blue-600 hover:bg-transparent hover:text-black dark:text-white  "
                href="#" @click="abrirModal">

                <span class="absolute -start-full transition-all group-hover:start-4">
                    <Plus />
                </span>

                <span class="text-sm font-medium transition-all group-hover:ms-4"> Agregar </span>
            </a>
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

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 dark:*:">
                    <tr v-for="item in categorias" :key="item.id"
                        class="*:text-gray-900 *:first:font-medium dark:*:text-white">
                        <td class="px-3 py-2 whitespace-nowrap">{{ item.nombre_categoria }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ item.descripcion }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ item.estado == 1 ? 'Activo' : 'Inactivo' }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">

                            <div class="flex gap-x-4">
                                <a class="inline-block rounded-sm border border-blue-600 bg-blue-600 px-5 py-3 text-sm font-medium text-black hover:bg-transparent hover:text-blue-600"
                                    href="#" @click="abrirModalEditar(item)">
                                    <Pencil />
                                </a>
                                <a class="inline-block rounded-sm border border-red-600 bg-red-600 px-5 py-3 text-sm font-medium text-black hover:bg-transparent hover:text-red-600"
                                    href="#" @click=confirmacion(item.id)>
                                    <Trash2 />
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <div class="fixed inset-0 z-50 grid place-content-center bg-black/50 p-4" role="dialog" aria-modal="true"
            aria-labelledby="modalTitle" v-if="mostrarModal">
            <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg dark:bg-gray-900">
                <h2 id="modalTitle" class="text-xl font-bold text-gray-900 sm:text-2xl dark:text-white">
                    Registro Categoria
                </h2>

                <form class="mt-4" @submit.prevent="enviarFormulario">
                    <div class="mb-3">
                        <label for="nombre_categoria">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200"> Nombre </span>
                            <input type="text" id="nombre_categoria" v-model="formulario.nombre_categoria"
                                class=" p-0.5 mt-0.5 w-full rounded border-gray-600 shadow-sm sm:text-sm dark:border-gray-600 dark:bg-blue-950 dark:text-blue">
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200"> Descripcion </span>
                            <input type="text" id="descripcion" v-model="formulario.descripcion"
                                class=" p-0.5 mt-0.5 w-full rounded border-gray-600 shadow-sm sm:text-sm dark:border-gray-600 dark:bg-blue-950 dark:text-blue">
                        </label>
                    </div>
                    <footer class="mt-6 flex justify-end gap-2">
                        <button type="submit"
                            class="flex justify-center items-center gap-2 rounded bg-gray-100 px-4 py-3 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
                            @click="cerrarModal">
                            <SquareX /> Cancelar
                        </button>

                        <button type="submit"
                            class="flex justify-center items-center gap-2 rounded bg-blue-600 px-4 py-3 text-sm font-medium text-black transition-colors hover:bg-blue-700">
                            <SaveAll /> Guardar
                        </button>
                    </footer>
                </form>
            </div>
        </div>
        <div class="fixed inset-0 z-50 grid place-content-center bg-black/50 p-4" role="dialog" aria-modal="true"
            aria-labelledby="modalTitle" v-if="mostrarModalEditar">
            <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg dark:bg-gray-900">
                <h2 id="modalTitle" class="text-xl font-bold text-gray-900 sm:text-2xl dark:text-white">
                    Editar Categoria
                </h2>

                <form class="mt-4" @submit.prevent="actualizarFormulario">
                    <div class="mb-3">
                        <label for="nombre_categoria">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                Nombre
                            </span>
                            <input type="text" id="nombre_categoria" v-model="formulario.nombre_categoria"
                                class="mt-0.5 w-full rounded border-gray-300 p-2 shadow-sm sm:text-sm dark:border-gray-600 dark:bg-gray-900 dark:text-white" />
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                Descripcion
                            </span>
                            <input type="text" id="descripcion" v-model="formulario.descripcion"
                                class="mt-0.5 w-full rounded border-gray-300 p-2 shadow-sm sm:text-sm dark:border-gray-600 dark:bg-gray-900 dark:text-white" />
                        </label>
                    </div>
                    <footer class="mt-6 flex justify-end gap-2">
                        <button type="button"
                            class="flex items-center justify-center gap-2 rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
                            @click="cerrarModalEditar">
                            <SquareX /> Cancelar
                        </button>

                        <button type="submit"
                            class="flex items-center justify-center gap-2 rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700">
                            <Save /> Guardar
                        </button>
                    </footer>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
