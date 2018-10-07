<template>
    <div>
        <h2 is="sui-header" class="centered" size="massive">
            commande {{order.id}} pour {{order.client.firstName}} {{order.client.lastName}}
            <sui-header-subheader>
                Date de commande: {{order.created|dateReadable}}
            </sui-header-subheader>
        </h2>

        <sui-grid>
            <sui-grid-row>
                <sui-grid-column :width="15">
                    <sui-card-group >
                    <sui-card :items-per-row="4"
                              v-for="item in order.items"
                              class="centered"
                              :key="item.id">
                        <sui-card-content>
                            <sui-card-header>
                                {{item.product.name}} ({{item.product.price}})
                            </sui-card-header>
                            <sui-card-description>
                                <p>pain: {{item.bread}} <br />
                                 <span v-if="item.vegetale">
                                   Crudités:  <sui-list horizontal v-if="item.vegetable">
                                                    <sui-list-item
                                                            v-for="vegetable in item.vegetables"
                                                            :key="vegetable.id">
                                                        {{vegetable}},
                                                    </sui-list-item>
                                              </sui-list>
                                </span>
                                <span v-else> <em>Pas de crudités</em></span>
                                </p>
                            </sui-card-description>
                        </sui-card-content>
                    </sui-card>
                </sui-card-group>
                    <p>
                    Coordonnées du client<br />
                    {{order.client.firstName}}{{order.client.firstName}} <br />
                    {{order.client.photne}}
                    {{order.client.email}}
                    {{order.client.street}} {{order.client.streetNr}} {{order.client.city}}
                </p>
                </sui-grid-column>
                <sui-grid-column :width="1">
                    <sui-button-group vertical labeled icons>
                        <sui-button
                                icon="check"
                                positive
                                label-position="left"
                                content="Prête"
                                @click="setDone(order.id)"
                        />
                        <sui-button
                                icon="arrow left"
                                label-position="left"
                                content="Abandon"
                                @click="back"
                        />
                        <sui-button
                                icon="trash"
                                negative
                                label-position="left"
                                content="Supprimer"
                                @click="deleteItem(order.id)"
                        />
                    </sui-button-group>
                </sui-grid-column>
            </sui-grid-row>
        </sui-grid>
    </div>
</template>

<script>
    import moment from 'moment' ;
    import { EventBus } from './EventBus.js';
    export default {
        name: 'OrderDetail',
        components: {},
        props: ['current'],
        sockets: {
            connect: function () {
                console.log('** order Detail ** socket connected');
            }
        },
        computed: {
          order: function(){
              return this.current;
          }
        },
        methods: {
            setDone: function (id) {
                Vue.http.patch('/api/order/'+id+'/done');
                EventBus.$emit('component', 'ListGrid');
            },
            deleteItem: function (id) {
                Vue.http.delete('/api/order/'+id);
                this.back();
            },
            back: function(){
                EventBus.$emit('component', 'ListGrid');

            }
        },
        beforeDestroy(){

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