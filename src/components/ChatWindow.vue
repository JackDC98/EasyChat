<template>
  <div class="window">
    <span v-if="messages.length < 1" class="message"><strong>Loading...</strong></span>
    <span v-for="(message, index) in messages" :key="index" class="message" :style="message.sent == false ? 'color: #999' : 'color: #000'">
      <i>"{{ message.content }}"</i>&ensp;<b style="text-transform:capitalize">--{{ message.sender }}</b>
    </span>
  </div>
</template>

<script>
import anime from 'animejs'

export default {
  mounted() {
    this.enter()
  },
  computed: {
    messages() {
      return this.$store.state.queue
    }
  },
  methods: {
    enter() {
      let tl = anime.timeline()

      tl.add({
        targets: '.window',
        translateX: '100%',
        easing: 'linear',
        duration: 0
      })
      .add({
        targets: '.window',
        translateX: '0%',
        easing: 'easeInOutQuint',
        duration: 1000
      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

div.window::-webkit-scrollbar {
  width: 1em;
}
 
div.window::-webkit-scrollbar-thumb {
  background-color: #ff6b6b;
  outline: 1px solid #f7fff7;
}

div.window {
  display: block;
  position: fixed;
  top: 0;
  bottom: 0;
  right: 0;
  left: 384px;
  border-left: 3px solid #565c63;
  background-color: #f7fff7;
  overflow-y: scroll;
}

span.message {
  display: block;
  font-family: 'Merriweather';
  font-size: 1.5em;
  margin: 0.5em 1em 0.5em 2em;
}

@media only screen and (max-width: 1280px) {
  div.window {
    right: 0;
    left: 0;
    bottom: 120px;
    top: 0;
    border: 0;
  }

  span.message {
    margin: 0.5em 1em;
    font-size: 1.5em;
  }
}
</style>
