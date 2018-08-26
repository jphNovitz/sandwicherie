<template>
        <sui-grid id="userDetail">
            <sui-grid-row  :columns="2">
                <sui-grid-column class="user_form" >
                <sui-form @submit.prevent="updateUser">
                    <sui-form-field>
                        <label>Nom d'utilisateur</label>
                        <input placeholder="Nom d'utilisateur"  v-model="user.username">
                    </sui-form-field>
                    <sui-form-field>
                        <label>Email</label>
                        <input placeholder="Email"  v-model="user.email">
                    </sui-form-field>
                    <sui-form-field>
                        <label>Nom</label>
                        <input placeholder="Nom"  v-model="user.last_name">
                    </sui-form-field>
                    <sui-form-field>
                        <label>Prenom</label>
                        <input placeholder="Prenom" v-model="user.first_name" >
                    </sui-form-field>
                    <label>Adresse </label>
                    <sui-form-fields>
                        <sui-input placeholder="Rue" v-model="user.street" />
                        <sui-input placeholder="num" v-model="user.street_nr" class="ui one wide column" />
                    </sui-form-fields>
                    <sui-form-field>
                        <label>Localité</label>
                        <input placeholder="localité" v-model="user.city" >
                    </sui-form-field>
                    <sui-button type="submit">Submit</sui-button>
                </sui-form>
            </sui-grid-column>
            </sui-grid-row>
        </sui-grid>
</template>
<script>
    export default {
        name: 'userDetail',
        props: ['user'],
        data() {
            return {}
        },
        methods: {
            updateUser: function () {
                this.$http.put('/api/s/profile', JSON.stringify(this.user)).then(response => {
                    this.user = response.body;
                }, error => {
                    console.log('error: ' + error.body)
                });
            }
        }
    }

</script>
<style scoped>

    #userDetail{
        text-align: left;
    }

    .user_form{
        margin-left: 25%;
    }

</style>