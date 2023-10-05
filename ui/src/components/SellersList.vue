<script setup>
import { getAllSellers } from '../services/sellerService'
</script>

<script>
let sellers = await getAllSellers()
console.log(sellers)
</script>

<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Editar</th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="seller in sellers" :key="seller.id">
        <td>{{ seller.id }}</td>
        <td>{{ seller.name }}</td>
        <td>{{ seller.email }}</td>
        <td><button class="btn btn-secondary">Editar</button></td>
      </tr>
    </tbody>
  </table>
</template>
