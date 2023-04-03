<template>
    <DataTable :data="data" class="display">
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
</template>

<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';

DataTable.use(DataTablesCore);

const props = defineProps({
    fruits: Array,
});

const data = props.fruits;
</script>

<style>
@import 'datatables.net-dt';
</style>