import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex);

export default new Vuex.Store({
    plugins: [createPersistedState()],
    state: {
        newTodo: '',
        todos: [],
        darkMode: false,
    },
    mutations: {
        newTodo (state, value) {
            state.newTodo = value;
        },
        add (state) {
            if (state.newTodo.trim().length < 1) return;
            
            state.todos.push({
                name: state.newTodo.trim(),
                finishedAt: null,
            });
            
            state.newTodo = '';
        },
        remove (state, todo) {
            const index = state.todos.indexOf(todo);
            state.todos.splice(index, 1);
        },
        update (state, todo) {
            var DateTime = new Date();
            if (todo.finishedAt) {
                todo.finishedAt = DateTime.toISOString();
            }
        },
        darkMode (state, value) {
            state.darkMode = value;
            if (state.darkMode) {
                document.body.classList.add('dark');
            } else {
                document.body.classList.remove('dark');
            }
        },
    },
    actions: {},
});