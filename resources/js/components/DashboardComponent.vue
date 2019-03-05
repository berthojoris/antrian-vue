<template>
    <section id="one" class="wrapper style1 special">
        <div class="container">
            <div class="row 150%">
                <div class="4u 12u(medium)" v-for="item in items" :key="item.id">
                    <section class="box">
                        <i v-if="item.status == 'SEDANG DIPROSES'" class="icon big rounded color1 fa-rocket"></i>
                        <i v-else-if="item.status == 'PACKING'" class="icon big rounded color3 fa-rocket"></i>
                        <i v-else class="icon big rounded color10 fa-rocket"></i>
                        <h3>{{ item.table_name }}</h3>
                        <h4 v-if="item.status == 'SEDANG DIPROSES'">{{ item.status }}</h4>
                        <h4 v-else-if="item.status == 'PACKING'">{{ item.status }}</h4>
                        <h4 v-else>{{ item.status }}</h4>
                        <p>Tanggal order : {{ item.created_at }}</p>
                    </section>
                </div>
            </div>
        </div>
    </section>
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
