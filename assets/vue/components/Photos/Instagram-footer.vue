<template>
    <div>
        <sui-card-group :items-per-row="cols">
            <sui-card class="fluid" v-for="(image, key) in images" :key="key">
                <a :href="image.source" target="_blank">
                    <sui-image :src="image.src" :title="image.caption"/>
                </a>
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
                access_token: '5919541710.5106335.21ac2fd8bfd644c2a0390d5a081ca6cb',
                images: [],
                base_url: 'https://api.instagram.com/v1/'
            }
        },
        computed: {
        },
        created() {
            axios.get(this.base_url+'users/self/media/recent',
                {params:  {
                        access_token: this.access_token,
                        count: this.count}} )
                .then(response => {
                    //this.images =  response.body
                    console.log('-++-++-++-'+response.data.data)
                    let raw = response.data.data
                    raw.map(object=>{
                        let image ={}
                        image.src = object.images.thumbnail.url;
                        if (object.caption) {
                            image.caption = object.caption.text ;
                        }
                        image.original = object.link ;
                        this.images.push(image)

                    })

                    console.log(response.body.data)
                }, response => {
                    console.log(response)
                });
        }
    }
</script>

<style>
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
</style>