new Vue({
        el: '#app',
        data: {
            show: true,

        },
        computed:    {
          button: function () {
              return document.getElementById('button').firstChild
          }
        },
        mounted() {
            const that = this
            document.addEventListener('click', (e) =>{
                console.log(this.show)
               if (e.target === this.button){
                   this.show = !this.show
               }  else if (this.show === false) {
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

