<template>
    <div>
      <!--  {{datas.data[0].images.standard_resolution.url}}
        <img :src="datas.data[0].images.standard_resolution.url" />
    -->
        <sui-card-group :items-per-row="cols" stackable>
                <sui-card class="fluid" v-for="(image, key) in images" :key="key">
                    <sui-image :src="image.src" />
                    <sui-card-content  v-bind:class="{ contentActive: isActive(key) }">
                            <sui-icon size="large"
                                      color="orange"
                                      name="hand point up"
                                      style="cursor: pointer"
                                      class="pointer-on"
                                      @click="setActive(key)"
                            />
                        <span class="centered pointer-off"
                              style="
                                position: absolute;
                                bottom: 15%;
                                left: 0%;
                                width: 13rem;">
                          <a :href="image.original" target="_blank"
                             class="white">
                              <sui-icon name="instagram"
                                        size="large"
                                        color="grey"/>
                          </a>
                         <a @click="setActive(key)"
                            class="white">
                                 <sui-icon size="large"
                                           color="grey"
                                           name="hand point down "
                                           class="pointer-off"/>
                         </a>
                        </span>
                        <sui-card-description>
                            <p class="elipsis">{{image.caption}}</p>
                        </sui-card-description>


                    </sui-card-content>

                </sui-card>
        </sui-card-group>
    </div>
</template>

<script>
import axios from 'axios'
    export default {
        name: 'Instagram',
        props: ['count', 'cols'],
        components: {axios},
        data() {
            return{
                active: [] ,
                access_token: '5919541710.5106335.21ac2fd8bfd644c2a0390d5a081ca6cb',
                images: [],
                base_url: 'https://api.instagram.com/v1/'/*,
                https://api.instagram.com/v1/tags/{tag-name}/media/recent?access_token=ACCESS-TOKEN
                https://api.instagram.com/v1/users/self/?access_token=ACCESS-TOKEN*/
            }
        },
        methods: {
            setActive: function (key) {
               if (this.active.indexOf(key) === -1 ){
                   this.active.push(key)
               } else {
                   this.active.splice(this.active.indexOf(key), 1) ;
               }
            },
            isActive: function (key) {
                if (this.active.indexOf(key) === -1 ){
                    return false
                } else {
                    return true;
                }
            }
        },
        computed: {
        },
        created() {
            axios.get(this.base_url+'users/self/media/recent',
                {params:  {
                        access_token: this.access_token,
                        count: this.count}
                } )
                .then(response => {
                    let raw = response.data.data
                    raw.map(object=>{
                        let image ={}
                        image.src = object.images.standard_resolution.url;
                        if (object.caption) {
                            image.caption = object.caption.text ;
                        }
                        image.original = object.link ;
                        this.images.push(image)

                    })

                }, response => {
                    console.log(response)
                });
        }
    }
</script>

<style scoped>

    .pointer-on{
        visibility: visible;
    }
    .pointer-off{
        visibility: hidden;

    }

    .ui.five.cards>.card{
        position: relative !important;
        overflow: hidden ;

    }

    .ui.card > .content, .ui.cards > .card > .content{
        border: none;
        position: absolute !important;
        top: 80%;
        height: 150%;
        width: 100%;
        background-color: rgba(255,255,255, .85 );
    }


    .ui.card>.content>.description, .ui.cards>.card>.content>.description {
        margin-top: 2rem !important;
        margin-bottom: 40% !important;
    }

    .contentActive {
        background-color: rgba(255,255,255, .9 ) !important;
        color: #000;
        top: 0% !important;
        height: 110% !important;
    }
    .contentActive .pointer-on{
        visibility: hidden;
    }
    .contentActive .pointer-off{
        visibility: visible;
    }
    .contentActive .elipsis{
        visibility: visible;
    }


    .light{
        border: none !important;
        background: none !important;
    }

    .elipsis{
        visibility: hidden;
        margin: auto;
        /* white-space: nowrap; */
        overflow: hidden;
        text-overflow: ellipsis;
        width: 95%;
        font-size: 2.5rem;
        height: 100px;
        text-align: center !important;
    }
    a.white{
        color: #ffffff;
    }
@media screen and (min-width: 640px) {

    .ui.card>.content>.description, .ui.cards>.card>.content>.description {
        margin-top: 1px !important;
    }
    .elipsis {
        font-size: 1rem;
        height: 60%;
    }
}
</style>