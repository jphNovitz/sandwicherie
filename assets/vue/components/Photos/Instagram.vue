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
                                      name="hand point up outline"
                                      style="cursor: pointer"
                                      @click="setActive(key)"
                            />
                        <span slot="right">
                          <a :href="image.original" target="_blank"
                             class="white">
                              <sui-icon name="instagram"
                                        size="large"
                                        color="white"/>
                          </a>
                         <a @click="setActive(key)"
                            class="white">
                                 <sui-icon size="large"
                                           color="white"
                                           name="hand point down outline" />
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
                    //this.images =  response.body
                    console.log(response)
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

                    console.log(response.data.data)
                }, response => {
                    console.log(response)
                });
        }
    }
</script>

<style scoped>
    .ui.five.cards>.card{
        position: relative !important;
        overflow: hidden ;

    }

    .ui.card > .content, .ui.cards > .card > .content{
        border: none;
        position: absolute !important;
        top: 76%;
        height: 150%;
        width: 100%;
        background-color: rgba(255,255,255, .85 );
    }


    .ui.card>.content>.description, .ui.cards>.card>.content>.description {
        margin-top: 2rem !important;
        margin-bottom: 2rem !important;
    }

    .contentActive {
        background-color: rgba(0,197,82, .75 ) !important;
        top: -34% !important;
    }


    .light{
        border: none !important;
        background: none !important;
    }

    .elipsis{
        margin: auto;
        /* white-space: nowrap; */
        overflow: hidden;
        text-overflow: ellipsis;
        width: 95%;
        font-size: 1.1rem;
        height: 100px;
        text-align: center !important;
    }
    a.white{
        color: #ffffff;
    }
</style>