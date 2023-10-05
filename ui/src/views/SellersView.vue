<script setup>
import Header from '../components/Header.vue'
import SellersList from '../components/SellersList.vue'
</script>

<script></script>

<template>
  <Header />
  <button class="btn btn-primary" @click="$router.push('createSeller')">Novo Vendedor</button>
  <SellersList />
</template>

<style></style>
