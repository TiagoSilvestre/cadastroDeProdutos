<template>
    <div class="login row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form @submit.prevent="register">
                        <div class="form-group row">
                            <label for="email">Nome:</label>
                            <input type="text" v-model="form.name" class="form-control" placeholder="Digite o nome">
                        </div>

                        <div class="form-group row">
                            <label for="email">Email:</label>
                            <input type="email" v-model="form.email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-group row">
                            <label for="password">Password:</label>
                            <input type="password" v-model="form.password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group row">
                            <input type="submit" value="Register">
                        </div>
                    </form>

                    <div class="errors" v-if="errors">
                        <ul>
                            <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                                <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import validate from 'validate.js';
    import {login} from '../../helpers/auth';

    export default {
        name: 'register',
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: ''
                },
                errors: null
            };
        },
        methods: {
            register() {
                this.errors = null;
                const constraints = this.getConstraints();
                const errors = validate(this.$data.form, constraints);

                if(errors) {
                    this.errors = errors;
                    return;
                }

                axios.post('/api/auth/register', this.$data.form)
                    .then((response) => {

                        this.$store.dispatch('login');

                        login(this.$data.form)
                            .then((res) => {
                                this.$store.commit("loginSuccess", res);
                                this.$router.push({path: '/'});
                            })
                            .catch((error) => {
                                this.$store.commit("loginFailed", {error});
                            });
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
                    password: {
                        presence: true,
                        length: {
                            minimum: 6,
                            message: 'Must be at least 6 digits long'
                        }
                    }
                };
            }            
        }
    }
</script>