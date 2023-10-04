<template>
    <form @submit.prevent="onSubmit()">
      <div class="form-group">
        <label>E-Mail</label>
        <input v-model="email" type="email" class="form-control">
      </div>

      <div class="form-group">
        <label>Senha</label>
        <input v-model="password" type="password" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
  </template>

  <script>
    import { signIn } from '../auth';
    export default {
      methods: {
        async onSubmit () {
          await signIn(this.email, this.password);
          this.$router.push('/');
        }
      }
    };
  </script>
