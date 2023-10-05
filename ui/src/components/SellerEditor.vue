<template>
  <form @submit.prevent="onSubmit()">
    <h2>Adicionar novo Vendedor</h2>
    <div class="input-group mb-3">
      <input
        type="text"
        class="form-control"
        placeholder="Nome"
        aria-label="Nome"
        aria-describedby="basic-addon1"
        v-model="name"
      />
    </div>

    <div class="input-group mb-3">
      <input
        type="text"
        class="form-control"
        placeholder="Email"
        aria-label="Email"
        aria-describedby="basic-addon2"
        v-model="email"
      />
    </div>

    <button type="submit" class="btn btn-success">Criar</button>
  </form>
</template>

<script>
import { createSeller } from '../services/sellerService'
export default {
  methods: {
    async onSubmit() {
      createSeller(this.name, this.email);

      this.$router.push('/sellers');
    }
  }
}
</script>
