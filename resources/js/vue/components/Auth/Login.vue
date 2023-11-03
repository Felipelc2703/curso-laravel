<template>

    
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-md">
            <form @submit.prevent="submit">
                <h2 class="mt-3 mb-6 text-center text-3xl tracking-tight font-bold text-gray-900">Sing in to your account</h2>
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

                <o-button :disabled="disabledBotton" class="float-right" variant="primary" native-type="submit">Enviar</o-button>
            </form>
        </div>
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
                },
                disabledBotton: false,
                loading: false,
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
                this.disabledBotton = true
                this.cleanErrorsForm() 
                this.$axios.post('/api/user/login', this.form).then((res) =>{

                    this.$root.setCookieAuth(res.data)
                    setTimeout(() => {
                        this.disabledBotton = false
                        window.location.href="/vue"

                    }, 1500)
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
                    this.disabledBotton = false
                })
            },
        },
    }
</script>