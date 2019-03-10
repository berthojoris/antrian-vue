<template>
<tr>
    <td v-bind:style="isActive">{{ item.name }}</td>
    <td>
        <button class="btn btn-success" @click="update(item)">Done</button>
        &nbsp;&nbsp;&nbsp;
        <button class="btn btn-danger" @click="remove(item)">Delete</button>
    </td>
</tr>
</template>

<style scoped>

</style>

<script>
import { mapMutations } from 'vuex'

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
        ...mapMutations(['add', 'remove', 'update']),
    }
}
</script>
