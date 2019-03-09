<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tugas Harian
                </div>
                <div class="card-body">
                    <input id="task" v-model="todo.name" type="text" name="task" value="" required="required" autofocus="autofocus" class="form-control" autocomplete="off" v-on:keyup.enter="addTask">
                    <hr>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Apa saja yang dikerjakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-for="(item, index) in listTask" :key="index">
                                <td>{{ item.name }}</td>
                            </tr>
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
            listTask: [],
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
