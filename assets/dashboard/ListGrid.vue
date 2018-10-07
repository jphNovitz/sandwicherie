<template>
    <div>
        <sui-card-group>
            <sui-card orange
                :items-per-row="4"
                v-for="(order, index) in orders"
                :key="order.id">
                <!--:class="{ active: actives[order.id], disabled: isActive(order.id)}" >-->
                <sui-card-content>
                    <sui-card-header>{{order.client.firstName}} {{order.client.lastName}} </sui-card-header>
                    <sui-card-meta>Commande N°: {{order.id}}
                                    <br /> ({{order.created|dateReadable}})
                    </sui-card-meta>
                    <sui-card-meta></sui-card-meta>
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
                <sui-card-content extra class="center aligned">
                <sui-button circular size="big" icon="shopping basket" positive @click="setDone(order.id)" :class="{ disabled: isActive(order.id)}" />
                <sui-button circular size="big" icon="hand paper" @click="setActive(order.id)" :class="{ disabled: isActive(order.id)}" />
                <sui-button circular size="big" icon="trash"  negative @click="deleteItem(order.id)" :class="{ disabled: isActive(order.id)}" />
                </sui-card-content>
            </sui-card>
        </sui-card-group>
    </div>
</template>

<script>
    import { EventBus } from './EventBus.js';
    import moment from 'moment'
    export default {
        name: 'ListGrid',
        components: {},
        props: ['orders'],
        watch: {
            orders: function(newVal, oldVal) {
                this.ordersList = newVal
            }
        },
        data() {return {
            ordersList: [],
            actives: []
        }},
        created() {
            this.$socket.emit('get_orders') ;
            EventBus.$on('activeItems', list=>{
                    this.actives = []
                    list.forEach(el=>{
                    this.actives.push(el)
                })
            }
            )
            EventBus.$on('remove', id=>{
                  this.removeTemplateITem(id)
            }
            )
        },
        mounted(){},
        methods: {
            refresh: function(){
                this.orders = []
                this.$socket.emit('refresh') ;
            },
            setDone: function (id) {
                Vue.http.patch('/api/order/'+id+'/done');
                this.refresh
            },
            deleteItem: function (id) {
                Vue.http.delete('/api/order/'+id+'/delete');
                this.refresh
            },
            removeTemplateITem:function (id) {
                let pos = -1 ;
                for (let i =0 ; i <  this.orders.length ; i++){
                    if (this.orders[i].id === id){
                        pos=i;
                        break ;
                    }
                }
                this.orders.splice(pos, 1);
            },
            setActive: function (id) {
                let order = this.orders.filter(o => {
                    return o.id === id ;
                })
                EventBus.$emit('current', order[0]);
                this.$socket.emit('activate_order', id) ;
            },
            isActive: function(id){
                if (this.actives.length > 0){
                    return (this.actives.indexOf(id) > -1) ;
                } else { return false ; }            }
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
    .active{
        opacity: .3;
    }

</style>