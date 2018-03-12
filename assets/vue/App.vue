<template>
    <div id="app">
        <div class="ui grid">
            <div class="sixteen wide column">
                <div class="ui center aligned breadcrumb ">
                    <h1 class="ui center aligned icon header">
                        <i class="circular users icon"></i>
                       La Clémentine
                    </h1>
                    <a class="section">Home</a>
                    <div class="divider"> / </div>
                    <a class="section">Store</a>
                    <div class="divider"> / </div>
                    <div class="active section">T-Shirt</div>
                </div>
            </div>
            <div class="four wide column"><button is="sui-button" primary>Follow</button></div>
            <div class="four wide column"><button is="sui-button" primary>Follow</button></div>
            <div class="four wide column"><button is="sui-button" primary>Follow</button></div>
            <div class="four wide column"><button is="sui-button" primary>Follow</button></div>
        </div>
        <button is="sui-button" primary>
            Follow
        </button>
    </div>
</template>
<script>
    import 'semantic-ui-css/semantic.css';
    export default {
        name: 'App'
    }
</script>