<script setup>
import Header from '../components/Header.vue'
import SellersList from '../components/SellersList.vue'
</script>

<script></script>

<template>
  <Header />
  <div class="container">
    <button class="btn btn-primary" @click="$router.push('createSeller')">Novo Vendedor</button>
    <SellersList />
  </div>
</template>

<style></style>
