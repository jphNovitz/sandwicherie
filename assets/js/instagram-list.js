import Vue from 'vue';

const app = new Vue({
    el: '#cards',
    delimiters: ['${', '}'],
    data: {
        expanded: []
    },
    // computed: {
    //     isExpanded: function (id){
    //         let pos = this.expanded.indexOf(id)
    //         return (pos > -1)
    //     }
    // },
    methods: {
        doExpand: function (id) {
            let pos = this.expanded.indexOf(id)
            if (pos > -1)
            {
                this.expanded.splice(pos)
            } else {
                this.expanded.push(id)
            }
        },
        isExpanded: function (id){
            let pos = this.expanded.indexOf(id)
            console.log(pos)
            if (pos > -1) return true
                else return false
        }
    }
})