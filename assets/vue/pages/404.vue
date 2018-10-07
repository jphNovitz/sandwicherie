<template>
<div>
    <div class="ui container">
        <sui-grid-column :width="16"  class="global" >
            <sui-card class="fluid">
                <sui-image src="images/common/404.png" />
            </sui-card>
        </sui-grid-column>
    </div>


</div>
</template>

<script>
    import list_allergies from '../Classes/Allergies_list'
    import userCheck from '../mixins/userCheck'
    export default {
        name: 'oups',
        data(){
            return {}
        }
    }

</script>
<style scoped>
    .global{
        min-height: 80vh;
        height: 80vh;
    }
</style>