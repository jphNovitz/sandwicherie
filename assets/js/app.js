/*************************************************************/
/** app.js used for glabal javascript                       **/
/**                                                         **/
/** part of laclementine project                            **/
/** @author: Novitz Jean-Philippe  <novitz@gmail.com        **/
/**                                                         **/
/** 2018                                                    **/
/*************************************************************/

import Vue from 'vue';


/******************/
/** lateral menu **/
/*****************/

new Vue({
    el: '#lateral-menu',
    data: {
        show: false,
    },
    computed:    {
        button: function () {
            // return document.getElementById('general-button')
            return document.querySelectorAll('#general-button')

        }
    },
    mounted() {

        const that = this
        document.addEventListener('click', (e) =>{
            that.button.forEach(b=>{
                if ((e.target === b) || (e.target === b.parentElement)) {
                    this.show = !this.show
                }else if (this.show === true) {
                    this.show = !this.show
                }
            })
        })
    }
});
