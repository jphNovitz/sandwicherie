<template>
    <div>
    <span id="test"></span>
    <nav id="menu">
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
                testPos: null
            }
        },
        mounted() {
            this.getWidth()
            let that = this
            window.addEventListener('resize', function () {
                that.getWidth()
            })
            window.addEventListener('scroll', function () {
                that.scrollTest()
                const menu = document.getElementById('menu')
                if (menu.getBoundingClientRect().y < 5) {
                    menu.style.position = 'sticky'
                    menu.style.top = '0px'
                    menu.style.margin = '0'
                }
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
                if (position ==0 && this.testPos<0){
                    menu.style.position = 'static'
                    const top = document.getElementById('top')
                    top.style.transform= "scale(1)"
                    top.style.display='block'
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
</style>