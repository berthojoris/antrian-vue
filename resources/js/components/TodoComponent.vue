<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tugas Harian
                </div>
                <div class="card-body">
                    <input id="task" v-model="todo.name" type="text" name="task" value="" autofocus="autofocus" class="form-control" autocomplete="off" v-on:keyup.enter="addTask">
                    <hr>
                    <div class="alert alert-info" role="alert" v-show="empty(listTask)">
                        Sedang tidak ada todo yg akan dikerjakan
                    </div>
                    <table class="table table-bordered table-striped" v-show="check(listTask)">
                        <thead>
                            <tr>
                                <th>Apa saja yang dikerjakan</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <comp-todo-item 
                                v-for="(item, index) in listTask" 
                                :item="item" 
                                :key="index" 
                                v-on:toggleTodo="toggleTodo" 
                                v-on:deleteTodo="deleteTodo">
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
export default {
    data() {
        return {
            listTask: [
                {
                    name: 'Bangun',
                    done: true,
                },
            ],
            todo: {
				name: '',
				done: false
			}
        }
    },
    methods: {
        addTask() {
            if(this.task != '') {
                this.listTask.push(this.todo)
				this.todo = {
					name: '',
					done: false
				}
                this.resetFom()
            }
        },
        resetFom() {
            this.todo.name = ''
        },
        toggleTodo(todo) {
            let index = this.listTask.indexOf(todo);
			this.listTask[index].done = !this.listTask[index].done
        },
        deleteTodo(todo) {
            let index = this.listTask.indexOf(todo);
			this.listTask.splice(index, 1)
        },
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
