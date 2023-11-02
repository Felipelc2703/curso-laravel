<template>
    <div>
        <form @submit.prevent="submit">
            <o-field 
                :variant="errors.login ? 'danger' : 'primary'" 
                message=""
                label="Username"
            >
                <o-input v-model="form.email">
                </o-input>
            </o-field>

            <o-field 
                :variant="errors.login ? 'danger' : 'primary'" 
                :message="errors.login"
                label="Password"
            >
                <o-input v-model="form.password" type="password">
                </o-input>
            </o-field>

            <o-button variant="primary" native-type="submit">Enviar</o-button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                },
                errors: {
                    login:''
                }
            }
        },
        created() {
            // console.log(this.$root.isLogIn)
            if(this.$root.isLogIn)
            {
                this.$router.push({name: "list"})
            }
        },
        methods: {
            cleanErrorsForm() {
                this.errors.login = ''
            },
            submit() {
                this.cleanErrorsForm() 
                this.$axios.post('/api/user/login', this.form).then((res) =>{

                    this.$root.setCookieAuth(res.data)
                    setTimeout(() => window.location.href="/vue", 1500)
                    this.$oruga.notification.open({
                        message: 'Login success',
                        position: 'bottom-right',
                        variant: 'success',
                        duration: 1000,
                        closable: true
                        });

                }).catch((error) => {
                    console.log(error)
                    if(error.response.data){
                        this.errors.login = error.response.data
                    }
                })
            },
        },
    }
</script>