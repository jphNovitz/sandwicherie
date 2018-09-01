import Vue from 'vue';

new Vue({
        el: '#app',
        data: {
            show: false,

        },
        computed:    {
          button: function () {
              return document.getElementById('button').firstChild
          }
        },
        mounted() {
            const that = this
            document.addEventListener('click', (e) =>{
               if (e.target === this.button){
                   this.show = !this.show
               }  else if (this.show === true) {
                   this.show = !this.show
               }
            })
        },
        methods: {
            test() {
                alert()
            }
        }
    });

