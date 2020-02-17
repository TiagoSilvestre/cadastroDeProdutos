<template>
    <div class="card novo-cliente-card">
        <div class="card-header">
            <h3>Cadastrar Produto</h3>
        </div>

        <div class="card-body">
            <form @submit.prevent="add">
                <table class="table">
                    <tr>
                        <th>Categoria</th>
                        <td>
                            <div class="select-container">
                                <select id="categories" v-model="selectedValue" class="form-control" placeholder="Selecione">
                                    <option :value="null" disabled>Selecione...</option>
                                    <option v-for="item in categories" :value="item.id">{{ item.title }}</option>
                                </select>
                                <router-link to="/categories/new">+ Cadastrar Categoria</router-link>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Título</th>
                        <td>
                            <input type="text" class="form-control" v-model="product.title" placeholder="Digite o título do produto"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Descrição</th>
                        <td>
                            <input type="text" class="form-control" v-model="product.description" placeholder="Digite a descrição"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Preço</th>
                        <td>
                            <input type="text" class="form-control" v-model="product.price" placeholder="Digite o preço"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Url da Imagem</th>
                        <td>
                            <input type="text" class="form-control" v-model="product.image" placeholder="Digite a Url da imagem"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <router-link to="/products" class="btn">Cancelar</router-link>
                        </td>
                        <td class="text-right">
                            <input type="submit" value="Cadastrar" class="btn btn-primary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="errors" v-if="errors">
            <ul>
                <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                    <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import validate from 'validate.js';

    export default {
        name: 'new-product',
        data() {
            return {
                product: {
                    title: '',
                    description: '',
                    category_id: '',
                    price: '',
                    image: ''
                },
                categories: [],
                selectedValue: null,
                errors: null
            };
        },
        mounted() {
            this.fetchCategories();
        },        
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            fetchCategories() {
                axios.get('/api/categories')
                    .then(res => {
                        this.categories = res.data.data;
                    })
                .catch(err => console.log(err));
            },
            add() {
                this.errors = null;

                this.$data.product.category_id = this.$data.selectedValue

                console.log(this.$data.product);
                
                const constraints = this.getConstraints();

                const errors = validate(this.$data.product, constraints);

                if(errors) {
                    this.errors = errors;
                    return;
                }

                axios.post('/api/product', this.$data.product)
                    .then((response) => {
                        this.$router.push('/products');
                    });
            },
            getConstraints() {
                return {
                    title: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'Must be at least 3 characters long'
                        }
                    },
                    description: {
                        presence: true,

                    },
                    price: {
                        presence: true,
                        numericality: true
                    },
                    image: {
                        presence: true
                    },
                    category_id: {
                        presence: true
                    }
                };
            }
        }
    }
</script>

<style>
.errors {
    background: lightcoral;
    border-radius:5px;
    padding: 21px 0 2px 0;
}
.select-container{
    display: flex;
}
.select-container select{
    max-width: 430px;
}
.select-container a{
    margin-left: 80px;
    padding-top: 7px;

}
</style>

