<template>
    <div>
        <div
                class="ui large sidebar vertical orange icon menu"
                :class="{ uncover: sidebarActive, visible: sidebarActive }"
        >
            <div class="ui fluid orange card">
                <div class="content">
                    <div class="header">
                        Bonjour Invité
                    </div>
                </div>
                <div class="extra content">
                    <div class="ui two buttons">
                        <div class="ui basic grey small button">Se connecter</div>
                        <div class="ui blue button">S' inscrire</div>
                    </div>
                </div>
            </div>
            <a class="item">
                <i class="home icon"></i>
                Accueil
            </a>
        </div>
        <div class="pusher">
            <header-site @opensesame="show"></header-site>
            <div v-click-out class="ui grid container" style="min-height: 100vh">
                toto
            </div>
        </div>
    </div>
</template>

<script>
    import headerSite from '~/components/Header.vue'

    export default {
        components: { headerSite },
        directives: {
            'click-out': {
                bind(el, binding, vnode) {
                    el.addEventListener('click', function() {
                        if (vnode.context.sidebarActive === true) {
                            vnode.context.sidebarActive = false
                        }
                    })
                }
            }
        },
        data() {
            return {
                sidebarActive: false
            }
        },
        methods: {
            show: function() {
                this.sidebarActive = !this.sidebarActive
            }
        }
    }
</script>

<style scopped>
    header {
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    .white {
        color: #fff !important;
    }
</style>
