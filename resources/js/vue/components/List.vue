<template>
    <div>
        <h1>Listado de post</h1>

        <o-button icon-left="plus" @click="$router.push({name: 'save'})">Crear</o-button>
        <!-- <router-link :to="{name:'save'}">Crear</router-link> -->
        <div class="mt-6"></div>

        <o-table :loading="isLoading" :data="posts.current_page && posts.data.length == 0 ? [] : posts.data">

            <o-table-column field="id" label="ID" numeric v-slot="p">
                {{ p.row.id}}
            </o-table-column>

            <o-table-column field="Title" label="titulo" v-slot="p">
                {{ p.row.title}}
            </o-table-column> 

            <o-table-column field="posted" label="Posteado" v-slot="p">
                {{ p.row.posted}}
            </o-table-column> 

            <o-table-column field="created_at" label="Fecha" v-slot="p">
                {{ p.row.created_at}}
            </o-table-column> 

            <o-table-column field="category" label="Categoria" v-slot="p">
                {{ p.row.category.title}}
            </o-table-column>

            <o-table-column field="slug" label="Acciones" v-slot="p">
                <router-link class="mr-3" :to="{name:'save',params:{ 'slug': p.row.slug }}">Editar   </router-link>
                <o-button 
                    icon-left="delete" 
                    :rounded="true" 
                    size="small" 
                    variant="danger" 
                    @click="deletePostRow = p; confirmDeleteActive=true"
                    
                    > 
                    Eliminar
                </o-button>
            </o-table-column>

        </o-table>

        <!-- modal -->
        <o-modal v-model:active="confirmDeleteActive">
            <div class="p-4">
                <p>¿Seguro que quieres eliminar el registro seleccionado</p>
            </div>

            <div class="flex flex-row-reverse gap-2 bg-gray-100 p-3">
                <o-button 
                    variant="danger" 
                    @click="deletePost(p)"
                >
                    Eliminar
                </o-button>
 
                <o-button
                    @click="confirmDeleteActive = false"
                >
                    Cancelar
                </o-button>
            </div>
        </o-modal>
        
        <br>

        <o-pagination
        v-if="posts.current_page && posts.data.length > 0 "
            @change="updatePage"
            v-model:current="currentPage"
            :total="posts.total"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="posts.per_page">
        </o-pagination>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts: [],
                isLoading: true,
                currentPage: 1,
                confirmDeleteActive: false,
                deletePostRow: ''
            }

        },
        async mounted() {
            // console.log(this.$cookies.get('auth')) 
            this.listPage()
            
            // this.$axios.get('/api/post').then((res) => {
            //     this.posts = res.data
            //     console.log(this.posts)
            //     this.isLoading = false
            // });
        },
        methods: {  
            updatePage(){
                setTimeout(this.listPage,100)  
            },
            listPage() {

                const config = {
                    // headers: {Authorization: `Bearrer ${this.$root.token}`}

                    // headers: {Authorization: `Bearrer ${this.$cookies.get('auth').token}`}

                    headers: {Authorization: 'Bearrer '+ this.$root.token}
                }
                // console.log("click"+ this.currentPage)
                this.isLoading = true
                // this.$axios.get('/api/post?page='+this.currentPage).then((res) => {
                    this.$axios.get('/api/post?page=' + this.currentPage, config).then((res) => {
                    this.posts = res.data
                    // console.log(this.posts)
                    this.isLoading = false
                });
            },
            deletePost() {

                const config = {
                    headers: {Authorization: 'Bearrer '+ this.$root.token}
                }
                this.confirmDeleteActive = false
                this.posts.data.splice(this.deletePostRow.index,1)
                // this.$axios.delete('/api/post/'+post.id)
                this.$axios.delete('/api/post/'+this.deletePostRow.row.id, config)

                this.$oruga.notification.open({
                message: 'Mensaje Eliminado',
                position: 'bottom-right',
                variant: 'danger',
                duration: 4000,
                closable: true
            })

            }
        }
    }
</script>