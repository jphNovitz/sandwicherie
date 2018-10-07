<template>
<div>
    <h2 is="sui-header" icon>
        <img src="../components/Menu/logo.png" class="medium icon  "/>
        {{site.title}}
        <sui-header-subheader>
            <br />{{site.subTitle}}
        </sui-header-subheader>
    </h2>
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
    <section class="ui stackable grid">
        <article class="four wide column computer"> &nbsp; </article>
        <article class="eight wide column computer">
            <p>
                {{site.adress}} <br />
                {{site.city}}
            </p>

            <p>
                Tél: {{site.phone}} <br />
                Email: {{site.email}}
            </p>

            <p>
                <a :href="site.SocialFacebook" class="ui facebook button">
                    <i class="facebook icon"></i>
                    Facebook
                </a>
                <a :href="site.SocialInstagram" class="ui instagram button">
                    <i class="instagram icon"></i>
                    Instagram
                </a>
            </p>

            <p>
                Tva: {{site.tva}}
            </p>
        </article>
        <article class="four wide column computer">  &nbsp; </article>
    </section>

</div>
</template>

<script>
      import Map from '../components/Map/Map'
      import userCheck from  '../mixins/userCheck'

    export default {
        name: 'contact',
        mixins: [userCheck],
        components: {
            Map
        },
        data(){
            return {}
        },
        computed: {
            site: function () {
                return this.$store.getters.site
            }
        }
    }

</script>
<style scoped>
    .medium {
        width: 7rem !important;
    }
</style>