<script setup>
import { getAllSales } from '../services/salesService';
</script>


<script>
let sales = await getAllSales();
console.log(sales)
</script>

<template>
<table class="table">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Date</th>
        <th scope="col">Price</th>
        <th scope="col">Seller</th>
        </tr>
    </thead>

    <tbody>
        <tr v-for="sale in sales" :key="sale.id">
        <td>{{ sale.id }}</td>
        <td>{{ sale.sale_date }}</td>
        <td>{{ sale.price }}</td>
        <td>{{ sale.seller_id }}</td>
        </tr>
    </tbody>
</table>
</template>
