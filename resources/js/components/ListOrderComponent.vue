<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">List Antrian Pesanan</div>
                
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID Meja</th>
                                <th scope="col">Nama Pemesan</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in items" :key="item.id">
                                <td>{{ item.table_id }}</td>
                                <td>{{ item.table_name }}</td>
                                <td v-if="item.status == 'SEDANG DIPROSES'"><span class="badge badge-info">{{ item.status }}</span></td>
                                <td v-else-if="item.status == 'PACKING'"><span class="badge badge-warning">{{ item.status }}</span></td>
                                <td v-else><span class="badge badge-success">{{ item.status }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data: function() {
            return  {
                items: [],
                statusPush: ''
            }
        },
        created () {
            this.callAPIFromDB()
        },
        mounted () {
            window.Echo.channel('orders').listen('OrderStatusUpdate', e => {
                let dataPost = e.data;
                this.statusPush = e.status
                var currentData = this.items

                var index = -1
                for (var i = 0; i < currentData.length; i++) {
                    if (currentData[i].table_id === dataPost.table_id) {
                        index = i
                        break
                    }
                }

                if (index !== -1) {
                    currentData.splice(index, 1, dataPost).reverse()
                } else {
                    currentData.push(dataPost).reverse()
                }

                if(this.statusPush == 'CREATED') {
                    toastr.info("Incoming Order from table ID <b>"+dataPost.table_id+"</b>")
                } else if(this.statusPush == 'UPDATED') {
                    toastr.success("Order status change for table ID <b>"+dataPost.table_id+"</b>")
                } else {
                    toastr.warning(this.statusPush)
                }
            })
        },
        methods: {
            callAPIFromDB: function () {
                axios.get('api/orderlist').then(response => (this.items = response.data));
            }
        }
    }
</script>
