<template>
<div>
    <section class="ui one column stackable center aligned grid">
        <call-to-action> </call-to-action>
    </section>
    <section  class="ui stackable grid">
        <aside class="six wide column middle aligned">
            <p>
                    <span class="emph">
                        <i class="ui quote left icon"></i>
                            Ouvert 6 jours sur sept
                            <br /> jusque 15h
                        <i class="ui quote right icon"></i>
                    </span>
            </p>
            <p> La sandwicherie 'La Clémentine' vous reçoit de 8:30 à 15:00 du lundi au vendredi,
                de 11:30 à 15h le samedi.
            </p>
            <p>
                Le parking est aisé, vous avez la possibilité de payer par bancontact
            </p>
        </aside>
        <Map class="ten wide column middle aligned" > </Map>
    </section>
    <section class="ui middle aligned grid container">
        <Search-Product></Search-Product>
        <Suggestions> </Suggestions>
    </section>
</div>
</template>

<script>
    import CallToAction from '../components/CallToAction/CallToAction'
    import Suggestions from '../components/Suggestions/Suggestions'
    import SearchProduct from '../components/SearchProduct/SearchProduct'
    import Map from '../components/Map/Map'

    export default {
        name: 'home',
        components: {
            CallToAction,
            Suggestions,
            SearchProduct,
            Map
        },
        data(){
            return {}
        }
    }

</script>