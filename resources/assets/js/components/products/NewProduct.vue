<template>
    <div class="card novo-cliente-card">
        <div class="card-header">
            <h3>Cadastrar Produto</h3>
        </div>

        <div class="card-body">
            <form @submit.prevent="add">
                <table class="table">
                    <tr>
                        <th>Titulo</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.title" placeholder="Customer Name"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Descrição</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.description" placeholder="Customer Email"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Preço</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.price" placeholder="Customer Phone"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Url da Imagem</th>
                        <td>
                            <input type="text" class="form-control" v-model="customer.image" placeholder="Customer Website"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <router-link to="/customers" class="btn">Cancel</router-link>
                        </td>
                        <td class="text-right">
                            <input type="submit" value="Create" class="btn btn-primary">
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
                customer: {
                    title: '',
                    description: '',
                    price: '',
                    image: ''
                },
                errors: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            add() {
                this.errors = null;

                const constraints = this.getConstraints();

                const errors = validate(this.$data.customer, constraints);

                if(errors) {
                    this.errors = errors;
                    return;
                }

                axios.post('/api/customers/new', this.$data.customer)
                    .then((response) => {
                        this.$router.push('/customers');
                    });
            },
            getConstraints() {
                return {
                    name: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'Must be at least 3 characters long'
                        }
                    },
                    email: {
                        presence: true,
                        email: true
                    },
                    phone: {
                        presence: true,
                        numericality: true,
                        length: {
                            minimum: 10,
                            message: 'Must be at least 10 digits long'
                        }
                    },
                    website: {
                        presence: true,
                        url: true
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
</style>

