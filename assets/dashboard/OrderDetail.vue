<template>
    <div>
        {{order}}
        <h2 is="sui-header" class="centered">
            commande {{order.id}} pour {{order.client.firstName}} {{order.client.lastName}}
            <sui-header-subheader>
                Date de commande: {{order.created|dateReadable}}
            </sui-header-subheader>
        </h2>

        <sui-card-group>
            <sui-card v-for="item in order.items" class="centered">
                <p>
                    {{item.product.name}} ({{item.product.price}}) <br />
                    pain: {{item.bread}} <br />
                    <sui-list horizontal v-if="item.vegetable">
                                <sui-list-item v-for="vegetable in item.vegetables" :key="vegetable.id"></sui-list-item>
                              </sui-list>

                     <span v-else> <em>Pas de crudités</em></span>
                </p>
            </sui-card>
        </sui-card-group>
        <p>
            Coordonnées du client<br />
            {{order.client.firstName}}{{order.client.firstName}} <br />
            {{order.client.photne}}
            {{order.client.email}}
            {{order.client.street}} {{order.client.streetNr}} {{order.client.city}}

        </p>
    </div>
</template>

<script>
    import moment from 'moment' ;

    export default {
        name: 'OrderDetail',
        components: {},
        props: ['orders'],
        sockets: {
            connect: function () {
                console.log('** order Detail ** socket connected');
            }

        },
        computed: {
          order: function(){
              return this.orders[0];
          }
        },
        created(){
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