<template>
  <div>
    <form @submit.prevent="login()">
      <div>
        <label for="email">Email</label>
        <input type="email" v-model="email" required>
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" v-model="password" required>
      </div>
      <input type="submit" value="Login">
    </form>
  </div>
</template>

<script>
export default {

  data() {
    return {
      email: '',
      password: '',
    }
  },

  methods: {
    async login() {
      await this.$auth.loginWith('laravelSanctum', {
        data: {
          email: this.email,
          password: this.password,
        }
      })
      this.$router.push('/logout')
    }
  },

}
</script>
