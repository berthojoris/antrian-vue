<template>
<tr>
    <td v-bind:style="isActive">{{ item.name }}</td>
    <td><button class="btn btn-success">Done</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-danger">Delete</button></td>
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
    }
}
</script>
