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
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Apa saja yang dikerjakan</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <comp-todo-item v-for="(item, index) in listTask" v-bind:item="item" v-bind:key="index"></comp-todo-item>
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
        }
    }
}
</script>
