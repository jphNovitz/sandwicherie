import Vue from 'vue';


/******************/
/** lateral menu **/
/*****************/
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
    }
});


//
// /*********************/
// /** floating button **/
// /*********************/
//
// Vue.config.delimiters = ['${', '}'];
// const action = new Vue({
//     el: '#action',
//     data() {
//         return {
//             menuActive: 'notVisible',
//             detailed: []
//         }
//     },
//     methods: {
//         showMenu: function () {
//             if (this.menuActive === 'notVisible') {
//                 this.menuActive = 'visible'
//             } else {
//                 this.menuActive = 'notVisible'
//             }
//         },
//         toggleDetail: function (id) {
//             let i = this.detailed.indexOf(id);
//             if (i > 0) {
//                 this.detailed.splice(i, 1)
//             } else {
//                 this.detailed.push(id);
//             }
//             console.log(this.detailed)
//         },
//         detailClass: function (id) {
//             if (this.detailed.indexOf(id) > -1) {
//                 return 'down';
//             } else {
//                 return 'right';
//             }
//         }
//     }
// })
