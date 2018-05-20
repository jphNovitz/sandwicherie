<template>
    <div class="ui padded middle aligned centered grid" id="nav-v">
        <div class="row  four column wide toolbar">
            <div class="left floated column  ">
                <img src="./logo.png"  class="ui medium image"/>
            </div>
            <div class="right floated column">
                <div class="middle aligned content">
                    <i   class="bars icon" @click="click"></i>
                </div>
            </div>
        </div>
        <div class="row menu-wrap"  v-bind:class="on ? 'menu-wrap-on' : ''" >
            <div class="ui fourteen wide column divided relaxed link list">
                <div class="item"><router-link :to="{name: 'home'}">Accueil</router-link></div>
                <div class="item">Produits</div>
                <div class="item">Horaires</div>
                <div class="item"><router-link :to="{name: 'contact'}">Contact</router-link>
                    <router-link :to="{ name: 'allergies'}" class="ui circular" >
                        <sui-button circular icon="info" size="mini"/>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"MenuMobile",
    data () {
        return {
            on: false
        }
    },
    watch:{
        $route (to, from){
            this.on = false;
        }
    },
    computed: {
    },
    methods: {
        click: function () {
            this.on = !this.on
        }
    }
}
</script>

<style scoped>
    #nav-v{
        display:block;
    }
    .menu-wrap{
        opacity: 0 ;
        height: 0px ;
        transition: height linear .6s, opacity linear .8s ;
    }
    .menu-wrap-on{
        opacity: 1 !important;
        height: 200px !important; ;
    }
    #nav-v .bars{
        line-height: inherit;
        font-size: 2.5rem;
        cursor: pointer;
    }

</style>