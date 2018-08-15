<template>
    <div>
        <sui-card-group>
            <sui-card :items-per-row="4" v-for="order in orders" :key="order.id">
                <sui-card-content>
                    <sui-card-header>{{order.client.firstName}} {{order.client.lastName}} </sui-card-header>
                    <sui-card-meta>{{order.created|dateReadable}}</sui-card-meta>
                    <sui-card-description>
                        <sui-list>
                            <sui-list-item v-for="item in order.items" :key="item.id">
                                <h3>{{item.product.name}} </h3><strong v-if="item.halal">halal</strong>
                                <sui-list-content>Pain: {{item.bread}}</sui-list-content>
                                <br />
                                    <sui-list-content>
                                        Crudités:
                                            <sui-list horizontal v-if="item.vegetables">
                                                <sui-list-item v-for="vegetable in item.vegetables" :key="vegetable.id">
                                                    {{vegetable}}
                                                </sui-list-item>
                                            </sui-list>
                                </sui-list-content>
                            </sui-list-item>
                        </sui-list>
                    </sui-card-description>
                </sui-card-content>
                <sui-button attached="bottom">
                    <sui-icon name="hand paper" /> Je prends
                </sui-button>
                <sui-button attached="bottom" positive>
                    <sui-icon name="shopping basket" /> Prêt
                </sui-button>
                <sui-button attached="bottom" negative @click="deleteItem(order.id)">
                    <sui-icon name="trash" /> Annuler
                </sui-button>
            </sui-card>
        </sui-card-group>
    </div>
</template>

<script>
    import moment from 'moment'
    export default {
        name: 'Dashboard',
        sockets:{
            connect: function(){
                console.log('socket connected') ;
            },
            orders: function(val){
                console.log('** Stock de commandes +1 **') ;
                let old_order = JSON.parse(val) ;
                console.log(old_order)
                this.orders.push(old_order) ;
            }
         },
        data () {
            return {
                orders: []
            }
        },
        mounted(){},
        methods: {
            deleteItem: function (id) {
                this.$socket.emit('pingServer', id)
            }
        },
        filters: {
            dateReadable: function (val) {
                if (val){
                    return moment(String(val)).format('DD/MM/YYYY (hh:mm)')
                }
            }
        }
    }

</script>

<style>
</style>