<template>
  <div>
    <p>Name: {{ $auth.user.name }}</p>
    <p>Email: {{ $auth.user.email }}</p>

    <input type="button" @click="logout()" value="Logout">
  </div>
</template>

<script>
export default {

  middleware: 'auth',

  methods: {
    async logout() {
      await this.$auth.logout()
      this.$router.push('/login')
    }
  },

}
</script>
