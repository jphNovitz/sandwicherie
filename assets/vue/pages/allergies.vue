<template>
<div>
    <sui-grid>
        <sui-grid-row>
            <sui-grid-column :width="16" >
                <sui-header>Information sur les Allergènes</sui-header>
                <p>La Clémentine utilise le moins de produits transformé possible.  Les préparations sont
                fraîches et confectionnées sur place, ceci pour offrir la meilleure expérience possible à nos clients.</p>
                <p>Il est inevitable que certaines préparations soit susceptible de provoquer l'une des 14 allergies alimentaires suivante:</p>

                <sui-table celled>
                <sui-table-header>
                    <sui-table-row>
                        <sui-table-header-cell>Allergie</sui-table-header-cell>
                        <sui-table-header-cell>Aliments à eviter</sui-table-header-cell>
                    </sui-table-row>
                </sui-table-header>

                <sui-table-body>
                    <sui-table-row v-for="(key, value) in list">
                        <sui-table-cell>{{value}}</sui-table-cell>
                        <sui-table-cell><span v-for="item in key"> {{item}}</span></sui-table-cell>
                    </sui-table-row>
                </sui-table-body>
                </sui-table>
            </sui-grid-column>
        </sui-grid-row>
        <sui-grid-row>
            <sui-grid-column >

            </sui-grid-column>
        </sui-grid-row>
    </sui-grid>



    <sui-message
            color="grey"
            icon="info">
        Télechargez le dépliant officiel de l'AFSCA
        <a href="http://www.afsca.be/autocontrole-fr/guides/qsfiches/_documents/2015-12-01_20_QSF_allergenes.pdf">ici</a>
    </sui-message>

</div>
</template>

<script>
    import list_allergies from '../Classes/Allergies_list'

    export default {
        name: 'allergies',
        components: {},
        data(){
            return {}
        },
        computed: {
            allergies: function () {
                return this.$store.getters.allergies
            },
            list: function () {
                return list_allergies(this.allergies)
            }
        }
    }

</script>
<style scoped>
    .medium {
        width: 7rem !important;
    }
</style>