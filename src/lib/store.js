import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        queue: [],
        users: [],
        connected: false,
        username: ''
    },
    mutations: {
        SET_QUEUE(state, queue) {
            state.queue = JSON.parse(queue.messages)
        },
        UPDATE_USERS(state, users) {
            state.users = JSON.parse(users.users)
        },
        SET_USERNAME(state, username) {
            state.username = username
        }
    },
    actions: {
        sync({ commit }, users) {
            commit('SET_QUEUE', users)
        },
        updateusers({ commit }, queue) {
            commit('UPDATE_USERS', queue)
        },
        setUsername({ commit }, username) {
            commit('SET_USERNAME', username)
        }
    }
})