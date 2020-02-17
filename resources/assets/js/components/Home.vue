<template>
   <div class="home-style">
    <div class="container home-container">
        <h3>Bem vindo a Home Page!</h3>
        <h4><u>App para Cadastros de produtos</u></h4>
        <p>
            Projeto desenvolvido com Laravel, no qual foi criada uma Api com autenticação.<br>
            No frontend foi utilizado o VueJS, VueRouter, Vuex, entre outros.<br>
            Nele é possível criar usuários, cadastrar, listar e ver produtos e categorias.  
        </p>
        
    </div>
</div>
</template>

<script>
    export default {
        name: 'home',
        computed: {
            welcome() {
                return this.$store.getters.welcome
            }
        }
    }
</script>

<style>
.home-style{
    height: 335px;
    background: #4a4afb;
    color: white;
    padding-top: 74px;
    margin-bottom: 5px;
    margin-top: -31px;
}
.home-container{
    padding: 20px;
}
</style>