<template>
    <div class="ui fourteen wide column">
        <sui-message class="flash" :class="flash_message.type" v-if="flash_message!==undefined" >
            {{flash_message.message}}
        </sui-message>
    </div>

</template>

<script>
export default {
    name: 'flashMessage',
    data (){
        return {
            flash_message: ''
        }
    },
    mounted() {
        this.flash_message = this.$session.flash.get('message');
    },
    created(){},
    watch: {},
    methods: { }
}
</script>

<style scoped>
    .flash{
        transition: all 5s ease;
    }
</style>