<template>
  <div class="dock">
    <input type="text" id="message" v-on:keyup="keymonitor" placeholder="Enter message...">
    <button id="submit" v-on:click="submit()" :disabled="messageEmpty" :class="messageEmpty ? 'submit' : 'submit submit-hovers'">Send</button>
  </div>
</template>

<script>

import anime from 'animejs'

export default {
  data: () => {
    return {
      messageEmpty: true
    }
  },
  props: {
    username: String
  },
  mounted() {
    this.enter()
  },
  methods: {
    keymonitor(event) {
      this.messageEmpty = (document.getElementById('message').value.length != 0) ? false : true
      if(event.key == "Enter") {
        this.submit()
      }
    },
    enter() {
      let tl = anime.timeline()

      tl
      .add({
        targets: '.dock',
        translateY: '100%',
        easing: 'linear',
        duration: 0
      })
      .add({
        targets: '.dock',
        translateY: '0%',
        easing: 'easeInOutQuint',
        duration: 1000
      })
    },
    submit() {
      let message = document.getElementById('message').value
      this.$socket.emit('sendmessage', JSON.stringify({
        content: message,
        sender: this.username,
        sent: true
      }))
      document.getElementById('message').value = ''
      this.messageEmpty = true
    }
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

div.dock {
  position: fixed;
  bottom: 0;
  left: 384px;
  right: 0;
  text-align: center;
  transform: translateY(100%);
  overflow: auto;
}

div.dock #message {
  font-family: 'Merriweather';
  font-size: 2em;
  padding: 0.5em 1em;
  border: 3px solid #565c63;
  background-color: #f7fff7;
  border-bottom: 0;
  border-radius: 4px 0 0 0;
}

div.dock .submit {
  font-family: 'Merriweather';
  font-size: 2em;
  padding: 0.5em 1em;
  border: 3px solid #565c63;
  border-bottom: 0;
  border-left: 0;
  background-color: #ff6b6b;
  color: #444;
  transition-timing-function: ease;
  transition-duration: 0.15s;
  border-radius: 0 4px 0 0;
}

div.dock .submit-hovers:hover {
  background-color: #fca4a4;
  cursor: pointer;
}

div.dock .submit-hovers:active {
  background-color: #813131;
  color: #fff;
}

@media only screen and (max-width: 1280px) {
  div.dock {
    right: 0;
    left: 0;
  }
}

@media only screen and (max-width: 768px) {
  div.dock {
    right: 0;
    left: 0;
    bottom: 0;
  }

  div.dock #message {
    display: block;
    padding: 0;
    width: 100%;
    font-size: 1.5em;
    border-radius: 0;
    border-right: 0;
    border-left: 0;
    height: 48px;
    text-align: center;
  }

  div.dock .submit {
    width: 100%;
    bottom: 0;
    border-radius: 0;
    border-right: 0;
    height: 80px;
  }

}

</style>
