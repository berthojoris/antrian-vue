<template>
<tr>
    <td v-bind:style="isActive">{{ item.name }}</td>
    <td>
        <button class="btn btn-success" v-on:click="toggleTodo">Done</button>
        &nbsp;&nbsp;&nbsp;
        <button class="btn btn-danger" v-on:click="deleteTodo">Delete</button>
    </td>
</tr>
</template>

<style scoped>

</style>

<script>
export default {
    props: ['item'],
    computed: {
        isActive() {
            if (this.item.done) {
                return 'text-decoration:line-through'
            }
        }
    },
    methods: {
        toggleTodo(){
			this.$emit('toggleTodo', this.item)
		},
		deleteTodo(){
			this.$emit('deleteTodo', this.item)
		}
    }
}
</script>
