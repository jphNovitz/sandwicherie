<template>
<div>
    <h2>Nos dernières photos sur instagram</h2>
    <instagram :cols="5" :count="20"></instagram>
</div>
</template>

<script>
    import Instagram from '../components/Photos/Instagram'
    import userCheck from '../mixins/userCheck';
    export default {
        name: 'photos',
        mixins: [userCheck],
        components: {Instagram},
        data() {
            return{

            }
        }
    }
</script>