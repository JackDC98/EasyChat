<template>
  <div class="users">
      <h2>Users</h2>
    <ul>
        <li v-for="(user, index) in users" :key="index">{{ user }}</li>
    </ul>
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
  computed: {
    users() {
      return this.$store.state.users
    }
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
    }
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

div.users {
    display: block;
    position: fixed;
    top: 128px;
    width: 280px;
    margin-left: 40px;
    color: #fff;
    text-align: center;
}

div.users h2 {
    font-size: 1.75em;
}

div.users ul {
    font-family: 'Merriweather';
    list-style-type: none;
    font-weight: bold;
    font-size: 1.25em;
    padding: 0;
}

</style>
