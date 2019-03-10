<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tugas Harian
                </div>
                <div class="card-body">
                    <input v-model="newTodo" @keyup.enter="add" type="text" name="task" value="" autofocus="autofocus" class="form-control" autocomplete="off" placeholder="Masukan todo vuex anda">
                    <hr>
                    <div class="alert alert-info" role="alert" v-show="empty(todos)">
                        Sedang tidak ada todo yg akan dikerjakan
                    </div>
                    <table class="table table-bordered table-striped" v-show="check(todos)">
                        <thead>
                            <tr>
                                <th>Apa saja yang dikerjakan</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <comp-todo-item 
                                v-for="(item, index) in todos" 
                                :item="item" 
                                :key="index">
                            </comp-todo-item>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style scoped>

</style>

<script>
import { mapState, mapMutations } from 'vuex'

export default {
    data() {
        return {
            todo: {
				name: '',
				done: false
			}
        }
    },
    computed: {
        ...mapState(['todos']),

        newTodo: {
            get () {return this.$store.state.newTodo},
            set (value) {return this.$store.commit('newTodo', value)},
        },
    },
    methods: {
        ...mapMutations(['add', 'remove', 'update']),

        check: function(arr) {
            if(_.isEmpty(arr)) {
                return false
            } else {
                return true
            }
        },
        empty: function(arr) {
            if(_.isEmpty(arr)) {
                return true
            } else {
                return false
            }
        }
    }
}
</script>
