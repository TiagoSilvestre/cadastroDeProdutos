<template>
    <div id="main">
        <Header/>
        <div class="content">
            <router-view></router-view>
        </div>
        <footer>
            <div class="container">
                <small><i>Desenvolvido por Tiago Silvestre</i></small>
            </div>
        </footer>          
    </div>
</template>

<script>
    import Header from './Header.vue';

    export default {
        name: 'main-app',
        components: {Header}
    }
</script>
