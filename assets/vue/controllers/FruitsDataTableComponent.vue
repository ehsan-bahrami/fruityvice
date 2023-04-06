<template>
    <div class="bg-white">
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                            alt="" />
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                        @click="mobileMenuOpen = true">
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
                <div class="hidden lg:flex lg:gap-x-12">
                    <a v-for="item in navigation" :key="item.name" :href="item.href"
                        class="text-sm font-semibold leading-6 text-gray-900">{{ item.name }}</a>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <a href="/" class="text-sm font-bold leading-6 text-gray-900">Fruityvice</a>
                </div>
            </nav>
            <Dialog as="div" class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
                <div class="fixed inset-0 z-50" />
                <DialogPanel
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                alt="" />
                        </a>
                        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
                            <span class="sr-only">Close menu</span>
                            <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <a v-for="item in navigation" :key="item.name" :href="item.href"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{
                                        item.name }}</a>
                            </div>
                            <div class="py-6">
                                <a href="/"
                                    class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-bold leading-7 text-gray-900 hover:bg-gray-50">Fruityvice</a>
                            </div>
                        </div>
                    </div>
                </DialogPanel>
            </Dialog>
        </header>

        <div class="relative isolate px-6 pt-14 lg:px-8">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
            </div>
            <div class="mx-auto max-w-4xl py-8 sm:py-16 lg:py-24">
                <h2 class="text-2xl">Fruits</h2>
                <hr class="mb-5">
                <div id="error-box" class="w-full hidden">
                    <div class="relative block w-full rounded-lg bg-indigo-300 p-4 text-base leading-5 text-white opacity-100 mb-5"
                        data-dismissible="alert">
                        <div class="mr-12">An error has occurred! You must have a maximum of 10 favorite fruits.</div>
                    </div>
                </div>
                <DataTable :data="fruitData" :columns="columns" class="display">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Family</th>
                            <th>Carbohydrates</th>
                            <th>Protein</th>
                            <th>Fat</th>
                            <th>Calories</th>
                            <th>Sugar</th>
                            <th>Favorite</th>
                        </tr>
                    </thead>
                </DataTable>
            </div>
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'

import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';

DataTable.use(DataTablesCore);

const props = defineProps({
    fruits: Array,
});

const fruitData = props.fruits;

const columns = [
    {
        data: 'name',
    },
    {
        data: 'family',
    },
    {
        data: 'carbohydrates',
    },
    {
        data: 'protein',
    },
    {
        data: 'fat',
    },
    {
        data: 'calories',
    },
    {
        data: 'sugar',
    },
    {
        data: 'favorite',
        "render": function (data, type, row, meta) {
            return '<p class="text-center" id="' +
                row['name'] +
                '">' +
                row['favorite'] +
                '</p>' +
                '<button class="flex-none block w-full rounded-full bg-indigo-600 px-3.5 py-1 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" onclick="(function() { document.getElementById(\'spinner-'+
                row['name'] +
                '\').className = \'\'; const response = fetch(\'/fruit/toggle-favorite/' +
                row['name'] +
                '\').then(response => response.json()).then(data => {document.getElementById(\'' +
                row['name'] +
                '\').innerHTML=data.fruit.favorite;document.getElementById(\'spinner-'+
                row['name'] +
                '\').className = \'hidden\';}).catch(error => {document.getElementById(\'error-box\').className = \'w-full\';document.getElementById(\'spinner-'+
                row['name'] +
                '\').className = \'hidden\';}); })()">'+
                '<div class="hidden" id="spinner-' +
                row['name'] +
                '"><div class="animate-spin inline-block w-3 h-3 border-[3px] border-current border-t-transparent text-gray-800 rounded-full dark:text-white" role="status" aria-label="loading">'+
                '<span class="sr-only">Loading...</span></div></div> Toggle</button>';
        }
    },
];

const navigation = [
    { name: 'Home', href: '/' },
    { name: 'Fruits', href: '/fruit' },
    { name: 'Favorite fruits', href: '/fruit/favorite' },
    { name: 'Github', href: 'https://github.com/ehsan-bahrami/fruityvice' },
]

const mobileMenuOpen = ref(false)
</script>

<style>
@import 'datatables.net-dt';
</style>