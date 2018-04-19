<template>
    <div>
        <!-- card with call to action -->

        <div class="ui stackable  grid" id="cta-wrapper">
            <div class="ui row bg ">
                <div class="sixteen wide middle aligned centered column">
                    <h1 class="ui sizer header">{{featured_products.name}}</h1>
                </div>
                <div class="five wide middle aligned centered column">
                    <button class="ui orange basic button">
                        <i class="cart plus icon"></i>
                        Je Commande
                    </button>
                </div>

            </div>
            <!-- cta wrapper -->
    </div>
    </div>
</template>
<script>
    export default {
        name: "call-to-action",
        computed: {
            featured_products: function () {
                let raw =  document.getElementById('featured_products').dataset.vars
                let list = JSON.parse(raw).list
                return list[0]
            }

        }
    }
</script>
<style scoped>
</style>