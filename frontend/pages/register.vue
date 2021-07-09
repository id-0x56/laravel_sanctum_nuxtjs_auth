<template>
  <div>
    <form @submit.prevent="register()">
      <div>
        <label for="name">Name</label>
        <input type="name" v-model="name" required>
      </div>
      <div>
        <label for="email">Email</label>
        <input type="email" v-model="email" required>
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" v-model="password" required>
      </div>
      <input type="submit" value="Register">
    </form>
  </div>
</template>

<script>
export default {

  data() {
    return {
      name: '',
      email: '',
      password: '',
    }
  },

  mounted() {
    this.$axios.$get('/api/sanctum/csrf-cookie');
  },

  methods: {
    async register() {
      await this.$axios.$post('/api/register', {
        name: this.name,
        email: this.email,
        password: this.password,
      })
      this.$router.push('/login')
    }
  },

}
</script>
