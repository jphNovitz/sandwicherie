<template>
    <div>
    <span id="test"></span>
    <nav id="menu" v-bind:class="{stuck: isStuck}">
        <MenuMobile v-if="mobile"> </MenuMobile>
        <MenuDesktop v-else> </MenuDesktop>
    </nav>
    </div>
</template>

<script>
    import MenuDesktop from './MenuDesktop'
    import MenuMobile from './MenuMobile'
    export default {
        name: "topMenu",
        components: {MenuDesktop, MenuMobile},
        data (){
            return {
                screen: {
                    width: 0
                },
                testPos: null,
                isStuck: null
            }
        },
        mounted() {
            this.getWidth()
            let that = this
            window.addEventListener('resize', function () {
                that.getWidth()
            })
            window.addEventListener('scroll', function () {
                const menu = document.getElementById('menu')
                if (menu.getBoundingClientRect().y < 5) {
                    that.isStuck = true
                }
                that.scrollTest()
            })
        },
        computed: {
            mobile: function () {
                if (this.screen.width > 500) return false
                else return true
            }
        }    ,
        methods: {
            getWidth: function () {
                this.screen.width = screen.width
            },
            scrollTest: function (){
                let test = document.getElementById('test')
                let position = test.getBoundingClientRect().y
                console.log(position)
                if (position > 105 && this.testPos < 105){
                    const top = document.getElementById('top')
                    top.style.transform = "scale(1)"
                    top.style.display = "block"
                    this.isStuck = false
                }
                this.testPos = position
            }
        },
        watch: {

        }
    }

</script>

<style scoped>
nav{
    margin: 1.5em auto;
    background-color: #fff;
    z-index: 10;
}
nav.stuck{
    position: fixed;
    top: 0px;
    margin: 0;
    width: 100%;

}
</style>