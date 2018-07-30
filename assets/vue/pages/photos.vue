<template>
<div>
    <h2>Nos dernières photos sur instagram</h2>
    <instagram :cols="5" :count="20"></instagram>
</div>
</template>

<script>
    import Instagram from '../components/Photos/Instagram'

    export default {
        name: 'photos',
        components: {Instagram},
        data() {
            return{

            }
        }
    }
</script>