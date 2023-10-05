<script setup>
import { useRoute } from 'vue-router';

const route = useRoute()

const sellerId = route.query.sellerId
const sellerName = route.query.sellerName

</script>

<script>
import { createSale } from '../services/salesService'

export default {
  methods: {
    async onSubmit(sellerId) {
      createSale(sellerId, this.price);

      this.$router.push('/sellers');
    }
  }
}
</script>

<template>
<h2>Nova venda</h2>
<br>
<h3>Venda de {{ sellerName }}</h3>
<form @submit.prevent="onSubmit(sellerId)">
<div class="form-group mb-3">
    <label>Valor</label>
    <input
    type="number"
    step="0.01"
    class="form-control"
    placeholder="Valor"
    aria-label="Valor"
    aria-describedby="basic-addon1"
    v-model="price"
    />
</div>

<button type="submit" class="btn btn-success">Criar</button>
</form>
<!-- {{ sellerId }} -->
</template>
