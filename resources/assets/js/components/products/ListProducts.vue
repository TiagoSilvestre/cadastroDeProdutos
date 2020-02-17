<template>
    <div>
        <div class="header-container">
            <h5>Lista de Produtos Cadastrados</h5>
            <div><router-link to="/products/new" class="btn btn-primary btn-block">+ Cadastrar Produto</router-link></div>
        </div>

        
        <form class="form-inline">
            <div class="form-group mb-2">
                <p style="margin-top: 15px;">Filtrar Produtos:</p>
            </div>

            <div class="form-group mx-sm-3 mb-2">
                <input class="form-control filter-input" type="text" name="filterName" v-model="filterName" placeholder="Digite o nome do produto...">
            </div>
            
            <a class="btn btn-primary mb-2 text-white" v-on:click.prevent="filterByName()">Filtrar</a>
            <a class="btn btn-light mb-2 ml-2" v-on:click.prevent="clearFilter()">Buscar Todos</a>
        </form>

        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nome do produto</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" v-bind:key="product.id">
                        <td scope="row">{{ product.title }}</th>
                        <td scope="row">{{ product.price }}</td>
                        <td scope="row">{{ product.category.title }}</td>
                        <td scope="row">
                            
                            <a href="#"><i class="material-icons">visibility</i></a>
                            <!--<a href="#">Ver</a>
                            <i class="material-icons">edit</i>
                            <i class="material-icons">delete_forever</i>
                            -->
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-if="noData">Não existem dados cadastrados.</div>
            <div v-if="loading">Carregando...</div>
        </div>

        <nav class="mt-4">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchProducts(pagination.prev_page_url)">Anterior</a>
                </li>

                <li class="page-item disabled">
                    <a class="page-link text-dark" href="#">Página {{ pagination.current_page }} de {{ pagination.last_page }}</a>
                </li>
            
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchProducts(pagination.next_page_url)">Próximo</a>
                </li>
            </ul>
        </nav>
        <small>* Paginação: 3 produtos por página</small>

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
            products: [],
            pagination: {},
            filterName: '',
            loading: true,
            noData: false
        };
    },
    created() {
        this.fetchProducts();
    },
    methods: {
        fetchProducts(page_url) {
            let vm = this;
            page_url = page_url || '/api/products';
            // fetch(page_url)
            axios.get(page_url)
                .then(res => {
                    this.products = res.data.data;
                    this.loading = false;
                    this.noData = (res.data.data.length == 0) ? true : false;
                    vm.makePagination(res.data.meta, res.data.links);
                })
            .catch(err => console.log(err));
    },
    makePagination(meta, links) {
        let pagination = {
            current_page: meta.current_page,
            last_page: meta.last_page,
            next_page_url: links.next,
            prev_page_url: links.prev
        }
        this.pagination = pagination;
    },
    filterByName() {
        if(this.filterName.trim() == '') {
            alert('Digite o nome do produto')
            return;
        }
        let vm = this;
        this.loading = true;
        axios.get('/api/products?title='+ this.filterName)
            .then(res => {
                this.products = res.data.data;
                this.loading = false;
                this.noData = (res.data.data.length == 0) ? true : false;
                vm.makePagination(res.data.meta, res.data.links);
            })
            .catch(err => console.log(err));
    },
    clearFilter() {
        this.filterName = '',
        this.fetchProducts();
    },

    deleteArticle(id) {
        if(confirm('Are You Sure?')) {
            fetch(`api/product/${id}`, {
                method: 'delete'
            })
            .then(res => res.json())
            .then(data =>{
                alert('Article Removed');
                this.fetchProducts()
            })
            .catch(err => console.log(err))
                
        }
    },
    addProduct() {
        if(this.edit === false) {
            // add
            fetch('api/product', {
                method: 'post',
                body: JSON.stringfy(this.product),
                headers: {
                    'content-type': 'application/json'
                }
            }).then(res => res.json())
            .then(data => {
                this.product.title = '';
                this.product.description = '';
                alert('Product added'); 
                this.fetchProducts();
            })
            .catch(err => console.log(err))
        } else {
            
        }
    }
  }
};
</script>