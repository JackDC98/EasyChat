<template>
  <div class="window">
    <h1>EasyChat.</h1>
    <input type="text" id="username" placeholder="Choose a name..." v-model="username">
    <a @click="exit()" href="#">Start chatting</a>
  </div>
</template>

<script>

import anime from 'animejs'

export default {
  data: () => {
    return {
      username: ''
    }
  },
  mounted() {
    this.enter()
  },
  methods: {
    enter() {
      let tl = anime.timeline()

      tl.add({
        targets: '.window',
        opacity: 1,
        duration: 1500
      })
    },
    exit() {
      let tl = anime.timeline({
        complete: () => {
          this.$store.state.username = this.username
          this.$socket.emit('setusername', this.username)
        }
      })

      tl.add({
        targets: '.window',
        opacity: 0,
        duration: 100,
        easing: 'linear'
      })
    }
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

div.window {
  font-family: 'Merriweather';
  display: block;
  position: fixed;
  border: 2px solid #565c63;
  width: 512px;
  height: 384px;
  min-width: 384px;
  top: 50%;
  left: 50%;
  margin-left: -12.5%;
  margin-top: -12.5%;
  text-align: center;
  color: #565c63;
  background-color: #f7fff7;
  opacity: 0;
}

div.window h1 {
  font-size: 3em;
}

div.window a {
  display: block;
  width: 50%;
  margin: 2em auto 0;
  font-family: 'Merriweather';
  padding: 0.5em 1em;
  border: 3px solid #565c63;
  background-color: #ff6b6b;
  color: #444;
  transition-timing-function: ease;
  transition-duration: 0.15s;
  border-radius: 4px;
  text-decoration: none;
  font-size: 1.5em;
}

div.window input {
  font-family: 'Merriweather';
  font-size: 1.5em;
  border: 3px solid #565c63;
  padding: 0.5em 1em;;
}

</style>
