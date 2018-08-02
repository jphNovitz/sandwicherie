<template>
    <div>
        <sui-form>
            <sui-form-field>
                <label>Nom</label>
                <input placeholder="Nom" >
            </sui-form-field>
            <sui-form-field>
                <label>Prenom</label>
                <input placeholder="Prenom" >
            </sui-form-field>
            <sui-button type="submit">Submit</sui-button>
        </sui-form>
    </div>
</template>
<script>
    export default {
        name: 'userDetail',
        props: ['user'],
        data() {
            return {

            }
        }
    }

</script>
<style>

</style>