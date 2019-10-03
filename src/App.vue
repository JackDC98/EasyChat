<template>
  <div id="app">
    <div v-if="!connected">
      <no-connection />
    </div>
    <div v-if="connected">
      <div v-if="username != ''">
        <chat-window />
        <chat-dock :username="username" />
        <users-list />
        <logo />
      </div>
      <div v-if="username == ''">
        <sign-in />
      </div>
    </div>
  </div>
</template>

<script>
import ChatDock from './components/ChatDock.vue'
import ChatWindow from './components/ChatWindow.vue'
import Logo from './components/Logo.vue'
import SignIn from './components/SignIn.vue'
import NoConnection from './components/NoConnection.vue'
import UsersList from './components/UsersList.vue'

export default {
  name: 'app',
  components: {
    ChatDock,
    ChatWindow,
    SignIn,
    Logo,
    NoConnection,
    UsersList
  },
  computed: {
    username() {
      return this.$store.state.username
    },
    connected() {
      return this.$store.state.connected
    }
  },
  sockets: {
      connect: function () {
        this.$store.state.connected = true
      },
      disconnect: function () {
        this.$store.state.connected = false
      },
      getusers: function(data) {
        this.$store.dispatch('updateusers', { users: data })
      },
      sync: function(data) {
        this.$store.dispatch('sync', { messages: data })
      }
  },
}
</script>

<style>
@import url('https://fonts.googleapis.com/css?family=Merriweather:400,700|Open+Sans&display=swap');

body {
  background-color: #292f36;
}

#app {
  margin: 0;
  font-family: 'Open Sans', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

h1, h2, h3, h4, h5, h6 {
  font-family: 'Merriweather';
}
</style>
