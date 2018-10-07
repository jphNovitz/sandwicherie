<template>
    <div>
        <h2>Vie Privée et utilisation de vos données</h2>
        <div class="ui grid">
            <sui-grid-column column="16">
            <p>
                <em>
                    La Clémentine souhaite vous informer de manière transparente sur l'utilisation qui est faite de
                    vos données.
                </em>
            </p>
            <sui-list>
                <sui-list-item v-for="privacy in privacies" :key="privacy.id" >
                  <a @click="toggleActive(privacy.id)">
                      <i class="ui caret icon" :class="[{down:  isActive(privacy.id)}, {right:  !isActive(privacy.id)}]">
                      </i>
                  </a>
                    {{privacy.title}}
                    <div :class="{ onClass: isActive(privacy.id) }" class="offClass" style="text-align: left">
                        <p>
                            {{privacy.intro}}
                        </p>
                        <p>
                            {{privacy.description}}
                        </p>
                        <p>
                            {{privacy.outro}}
                        </p>
                    </div>
                </sui-list-item>
            </sui-list>
            </sui-grid-column>
        </div>
    </div>

</template>

<script>

    import userCheck from '../mixins/userCheck'

    export default {
        name: 'privacy',
        mixins: [userCheck],
        components: {},
        data(){
            return {
                active: ''
            }
        },
        computed: {
            privacies: function () {
                return this.$store.getters.privacy
            }
        },
        methods: {
            toggleActive: function (id) {
                if (this.active === id){
                    this.active = ''
                }else {
                    this.active = id;
                }
            },
            isActive(id){
                return id === this.active
            }
        }
    }
</script>

<style scoped>
.offClass{
    display: none !important;
}
.onClass {
    display: block !important;
}
</style>