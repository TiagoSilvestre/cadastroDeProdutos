<template>
    <div class="card novo-cliente-card">
        <div class="card-header">
            <h4>Cadastrar Categoria</h4>
        </div>

        <div class="card-body">
            <form @submit.prevent="add">
                <table class="table">
                    <tr>
                        <th>Título</th>
                        <td>
                            <input type="text" class="form-control" v-model="category.title" placeholder=""/>
                        </td>
                    </tr>
                  
                    <tr>
                        <td>
                            <router-link to="/categories" class="btn">Cancelar</router-link>
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
                category: {
                    title: ''
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

                const errors = validate(this.$data.category, constraints);

                if(errors) {
                    this.errors = errors;
                    return;
                }

                axios.post('/api/category', this.$data.category)
                    .then((response) => {
                        this.$router.push('/categories');
                    });
            },
            getConstraints() {
                return {
                    title: {
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
</style>

