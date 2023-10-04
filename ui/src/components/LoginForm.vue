<template>
    <form @submit.prevent="onSubmit()">
      <fieldset>
        <label>E-Mail</label>
        <input v-model="email" type="email">
      </fieldset>

      <fieldset>
        <label>Senha</label>
        <input v-model="password" type="password">
      </fieldset>

      <fieldset>
        <button type="submit">Entrar</button>
      </fieldset>
    </form>
  </template>

  <script>
    import { signIn } from '../auth';
    export default {
      methods: {
        async onSubmit () {
          await signIn(this.email, this.password);
          this.$router.push('/home');
        }
      }
    };
  </script>
