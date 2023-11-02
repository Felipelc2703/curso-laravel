import {createRouter, createWebHistory} from "vue-router"
import List from './components/List.vue'
import Save from './components/Save.vue'
import Login from './components/Auth/Login.vue'

import { useCookies } from "vue3-cookies"

const {cookies} = useCookies()

const routes = [
    {
        name: 'list',
        path: '/vue',
        component: List
    },
    {
        name: 'save',
        path: '/vue/save/:slug?',
        component: Save
    },
    {
        name: 'login',
        path: '/vue/login',
        component: Login
    }
]

const router =  createRouter({
    history: createWebHistory(),
    routes: routes,
})


/*Validacion de autenticacion de usuario
Si el usuario no encuentra autenticado direcciona a la pantalla que se mencione
por lo habitual al login
*/
router.beforeEach(async (to,from,next) => {
    const auth = cookies.get('auth')
    console.log("dsdsd",window.Laravel.isLogIn)

    if(!auth && to.name != 'login')
    {
        return next({name: 'login'})
    }
    return next()
})

export default router