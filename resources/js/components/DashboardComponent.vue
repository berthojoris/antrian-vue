<template>
<div class="panel">
    <section id="one" class="wrapper style1 special">
        <div class="container">
            <header class="major" v-show="checkEmptyArr(items)">
                <h2>Sedang Tidak Ada Antrian Saat Ini</h2>
                <p>Layar Akan Menampilkan Antrian Jika Ada Pesanan</p>
            </header>
            <div class="row 150%">
                <div class="4u 12u(medium)" v-for="item in items" :key="item.id">
                    <section class="box">
                        <i v-if="item.status == 'SEDANG DIPROSES'" class="icon big rounded color1 fa fa-cutlery"></i>
                        <i v-else-if="item.status == 'SIAP'" class="icon big rounded color7 fa fa-cutlery"></i>
                        <i v-else class="icon big rounded color10 fa fa-cutlery"></i>
                        <h3>{{ item.table_name }}</h3>
                        <h4 v-if="item.status == 'SEDANG DIPROSES'">MEJA {{ item.table_id }} | {{ item.status }}</h4>
                        <h4 v-else-if="item.status == 'SIAP'">MEJA {{ item.table_id }} | {{ item.status }}</h4>
                        <h4 v-else>MEJA {{ item.table_id }} | {{ item.status }}</h4>
                        <p>Waktu order : {{ item.created_at }}</p>
                    </section>
                </div>
            </div>
        </div>
    </section>
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

                if(this.statusPush == "UPDATED") {
                    let check = ''
                    let sort = []
                    check = _.find(currentData, function(element) { 
                        return element.table_id == dataPost.table_id 
                    })
                    currentData.splice(currentData.indexOf(check), 1)
                    currentData.push(dataPost)
                    sort = _.sortBy(currentData, [function(o) { return o.updated_at; }])
                    this.items = _.reverse(sort);
                } else if(this.statusPush == "DELETED") {
                    let found = ''
                    found = _.find(currentData, function(element) { return element.table_id == dataPost.table_id })
                    currentData.splice(currentData.indexOf(found), 1)
                    currentData.reverse()
                } else {
                    currentData.push(dataPost)
                    currentData.reverse()
                }

                if(this.statusPush == 'CREATED') {
                    toastr.info("Incoming Order from table ID <b>"+dataPost.table_id+"</b>")
                } else if(this.statusPush == 'UPDATED') {
                    toastr.success("Order status change for table ID <b>"+dataPost.table_id+"</b>")
                } else if(this.statusPush == 'DELETED') {
                    toastr.success("Order deleted for table ID <b>"+dataPost.table_id+"</b>")
                }
                else {
                    toastr.warning(this.statusPush)
                }
            })
        },
        methods: {
            callAPIFromDB: function () {
                axios.get('api/orderlist').then(response => (this.items = response.data));
            },
            checkEmptyArr: function(arr) {
                return _.isEmpty(arr)
            }
        }
    }
</script>
