<template>
  <div class="logo">
    <h1 @click="home" @mouseover="spin">EasyChat.</h1>
  </div>
</template>

<script>

import anime from 'animejs'

export default {
  data: () => {
    return {
      //
    }
  },
  mounted() {
    this.enter()
  },
  methods: {
    enter() {
      let tl = anime.timeline()

      tl
      .add({
        targets: '.logo',
        translateX: '-100%',
        easing: 'linear',
        duration: 0
      })
      .add({
        targets: '.logo',
        translateX: '0%',
        easing: 'easeInOutQuint',
        duration: 1000
      })
    },
    home() {
        let tl = anime.timeline({
            complete: () => {
                this.$store.state.username = ''
                this.$socket.emit('unsetusername', this.username)
            }
        })

        tl
        .add({
            targets: '.logo',
            translateX: '0%',
            easing: 'linear',
            duration: 0
        })
        .add({
            targets: '.logo',
            translateX: '-100%',
            easing: 'easeInOutQuint',
            duration: 1000
        })
    },
    spin() {
      let tl = anime.timeline()

      tl
      .add({
        targets: '.logo',
        rotate: '0',
        easing: 'linear',
        duration: 0
      })
      .add({
        targets: '.logo',
        rotate: '360',
        easing: 'easeOutBack',
        duration: 2000
      })
    }
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

div.logo {
  width: 360px;
  text-align: center;
}

div.logo h1 {
  color: #f7fff7;
  font-size: 3em;
  cursor: pointer;
}

@media only screen and (max-width: 1280px) {
  div.logo {
    display: none;
  }
}

</style>
