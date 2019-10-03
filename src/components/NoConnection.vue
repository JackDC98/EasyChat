<template>
  <div class="no-conn">
    <h1 id="text" v-on:click="spin()">No Connection</h1>
  </div>
</template>

<script>

import anime from 'animejs'

export default {
  mounted() {
    this.enter()
  },
  methods: {
    enter() {
      let tl = anime.timeline()

      tl
      .add({
        targets: '#text',
        translateY: '600%',
        easing: 'linear',
        duration: 0
      })
      .add({
        targets: '#text',
        translateY: '0%',
        easing: 'easeInOutQuint',
        duration: 1000
      })
    },
    spin() {
      let tl = anime.timeline()

      tl
      .add({
        targets: '#text',
        rotate: '0',
        easing: 'linear',
        duration: 0
      })
      .add({
        targets: '#text',
        rotate: '360',
        easing: 'easeOutBack',
        duration: 1000
      })
    }
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  div.no-conn {
    display: block;
    position: fixed;
    width: 50%;
    left: 50%;
    top: 40%;
    margin-left: -25%;
    text-align: center;
    color: #fff;
    font-size: 2.5em;
    cursor: pointer;
  }
</style>
