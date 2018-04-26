<template>
    <nav id="menu">
        <MenuMobile v-if="mobile"> </MenuMobile>
        <MenuDesktop v-else> </MenuDesktop>
    </nav>
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
                }
            }
        },
        mounted() {
            this.getWidth()
            let that = this
            window.addEventListener('resize', function () {
                that.getWidth()
            })
            document.addEventListener('scroll', function () {
                const menu = document.getElementById('menu')

                if (menu.getBoundingClientRect().y < 5) {
                    console.log(menu.getBoundingClientRect().y)
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
            }
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