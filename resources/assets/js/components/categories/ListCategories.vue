<template>
    <div>
        <div class="header-container">
            <h5>Lista de Categorias Cadastradas</h5>
            <div><router-link to="/categories/new" class="btn btn-primary btn-block">+ Cadastrar Categoria</router-link></div>
        </div>

        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nome da categoria</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in categories" v-bind:key="product.id">
                        <td scope="row">{{ product.title }}</th>
                        <td scope="row">
                            <a href="#"><i class="material-icons">visibility</i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-if="noData">Não existem dados cadastrados.</div>
            <div v-if="loading">Carregando...</div>
        </div>
    </div>
</template>


<style>
    .header-container{ display: flex; justify-content: space-between; }
    .header-container div a{width: 195px;}
    .filter-input{ width: 315px!important; }
</style>



<script>
export default {
    data() {
        return {
            categories: [],
            loading: true,
            noData: false
        };
    },
    created() {
        this.fetchProducts();
    },
    methods: {
        fetchProducts(page_url) {
            page_url = page_url || '/api/categories';
            axios.get(page_url)
                .then(res => {
                    this.categories = res.data.data;
                    this.loading = false;
                    this.noData = (res.data.data.length == 0) ? true : false;
                })
            .catch(err => console.log(err));
    }
  }
};
</script>