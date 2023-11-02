<template>
    <div>
        <header>
            <div class="flex gap-3 bg-gray-200">
                <router-link v-if="!$root.isLogIn" :to="{name: 'login'}">Login</router-link>
                <o-button v-if="$root.isLogIn" variant="danger" @click="logout">logout</o-button>

                <p v-if="$root.isLogIn">{{ $root.user.name }}</p>
                <!-- <router-link :to="{name: 'login'}"></router-link> -->
            </div>
        </header>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isLogIn: false,
                user: '',
                token: '',
            }
        },
        created() {
            if(window.Laravel.isLogIn) 
            { 
                this.isLogIn = true
                this.user = window.Laravel.user
                this.token = window.Laravel.token
            } else {
                const auth = this.$cookies.get('auth')
                // console.log("dsdssdds",auth)
                if(auth){
                    
                    this.isLogIn = true
                    this.user = auth.user
                    this.token = auth.token


                    this.$axios.post('/api/user/token-check', {
                        'token': auth.token
                    }).then(()=>{}).catch(()=>{
                        this.setCookieAuth('' )
                        window.location.href='/vue/login'
                    })
                }
            }
        },
        methods: {
            logout() {
                this.$axios.post('/api/user/logout',{
                    token: this.token 
                }).then((res) => {
                    this.setCookieAuth('' )
                    window.location.href='/vue/login'
                })
            },
            setCookieAuth(data) {
                this.$cookies.set('auth', data)
            }
        }
    }
</script>