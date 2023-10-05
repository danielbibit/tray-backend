<script setup>
import { getAllSellers } from '../services/sellerService'
import { sendSellerReport } from '../services/reportsService';
</script>

<script>
let sellers = await getAllSellers()

export default {
  methods: {
    async sendReport(seller_id) {
      sendSellerReport(seller_id);

      // this.$router.push('/sellers');
    }
  }
}
</script>

<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Ação</th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="seller in sellers" :key="seller.id">
        <td>{{ seller.id }}</td>
        <td>{{ seller.name }}</td>
        <td>{{ seller.email }}</td>
        <td>
          <button class="btn btn-primary" @click="$router.push(
            {'name':'createSale',
            'query': {
              'sellerId': seller.id,
              'sellerName': seller.name
            }})">Nova Venda</button>
          <button class="btn btn-warning" @click.prevent="sendReport(seller.id)" >Enviar Relatório</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>
