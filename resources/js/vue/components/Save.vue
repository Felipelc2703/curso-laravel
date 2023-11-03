<template>
    <div class="container mx-auto">
        <div class="mt-6 mb-2 px-6 py-4 bg-white shadow-md rounded-md">

            <h1 v-if="postEditar">Actualizar Post: <span class="font-bold"> {{ post.title }}</span></h1>
            <h1 v-else>Crear Post</h1>

            <form @submit.prevent="submit">
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <div class="col-span-2">
                        <o-field label="Titulo" :variant="postError.title ? 'danger' : 'primary'" :message="postError.title">
                            <o-input  v-model="post.title"></o-input>
                        </o-field>
                    </div>

                    <o-field label="Descripción" 
                        :variant="postError.description ? 'danger' : 'primary'" 
                        :message="postError.description"
                        >
                        <o-input type="textarea"  v-model="post.description"></o-input>
                    </o-field>

                    <o-field label="contenido" :variant="postError.content ? 'danger' : 'primary'" :message="postError.content">
                        <o-input type="textarea"  v-model="post.content"></o-input>
                    </o-field>

                    <o-field label="Categoria" :variant="postError.category_id ? 'danger' : 'primary'" :message="postError.category_id" >
                        <o-select placeholder="Seleccione una categoria" v-model="post.category_id">
                            <option v-for="c in categories" v-bind:key="c.id" :value="c.id">{{ c.title }}</option>
                        </o-select>
                    </o-field>

                    <o-field label="Publicado" :variant="postError.posted ? 'danger' : 'primary'" :message="postError.posted">
                        <o-select placeholder="Seleccione un estado" v-model="post.posted">
                            <option value="yes">Si</option>
                            <option value="not">No</option>
                        </o-select>
                    </o-field>

                    <div class="flex gap-2" v-if="postEditar">
                        <o-field :message="fileError">
                            <o-upload v-model="file">
                                <o-button tag="a" variant="primary">
                                    <o-icon icon="upload"></o-icon>
                                    <span>Click para cargar</span>
                                </o-button>
                            </o-upload>

                            <o-button 
                                icon-left="upload"
                                @Click="upload()"
                            >
                                Subir
                            </o-button>
                        </o-field>
                    </div>


                    <div class="flex gap-2" v-if="postEditar">
                        <o-field :message="fileError">
                            <o-upload v-model="filesDaD" multiple drag-drop>
                                <section multiple drag-drop>
                                    <o-icon icon="upload"></o-icon>
                                    <span>Drag and Drop para cargar archivos</span>
                                </section>
                            </o-upload>

                            <o-button 
                                icon-left="upload"
                                @Click="upload()"
                            >
                                Subir
                            </o-button>
                        </o-field>

                        <span v-for="(file, index) in filesDaD" :key="index">
                            {{ file.name }}
                            <o-button
                                icon-left="times"
                                size="small"
                                native-type="button"
                                @click="deleteDropFile(index)">
                            </o-button>
                        </span>
                    </div>
                    
                </div>
                
                <br>

                <o-button variant="primary" native-type="submit">Enviar</o-button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: [],
                file: null,
                fileError: '',

                filesDaD: null,
                post: {
                    id: null,
                    title: '',
                    description: '',
                    content: '',
                    category_id: '',
                    posted: '',
                },

                postError: {
                    title: '',
                    description: '',
                    content: '',
                    category_id: '',
                    posted: '',
                },
                postEditar: '',
            }
        },
        async mounted() {
            if(this.$route.params.slug)
            {
                await this.getPost()
                // this.initPost() 

                console.log(this.postEditar)
            }
            // this.$route.params.slug != '' ? this.getPost : 
            this.getCategories()
            console.log(this.post)
        },
        // created() {
        //     this.getCategories()
        // },
        
        methods: {
            upload()
            {
                const formData = new FormData()
                formData.append("image",this.file)
                
                this.$axios.post("/api/post/upload/"+this.post.id,formData,{
                    headers: {
                        "content-type": "multipart/form-data",
                        "Authorization": 'Bearrer '+this.$root.token,
                    }
                }).then((res) =>{
                    console.log(res)
                }).catch((error) =>{
                    this.fileError = error.response.data.message
                })
            },

            uploadDaD()
            {
                const formData = new FormData()
                formData.append("image",val[val.length-1])
                
                this.$axios.post("/api/post/upload/"+this.post.id,formData,{
                    headers: {
                        "content-type": "multipart/form-data",
                        "Authorization": 'Bearrer '+ this.$root.token,
                    }
                }).then((res) =>{
                    console.log(res)
                }).catch((error) =>{
                    this.fileError = error.response.data.message
                })
            },
            clearErrorsPosts()
            {
                this.postError.title = ''
                this.postError.description= ''
                this.postError.content= ''
                this.postError.category_id= ''
                this.postError.posted= ''
            },
            getCategories() {
                const config = {
                    headers: {Authorization: 'Bearrer '+this.$root.token}
                }
                this.$axios.get("/api/category/all", config).then(res =>{
                    this.categories = res.data
                    console.log(res.data)
                })
            },
            async getPost() {

                const config = {
                    headers: {Authorization: 'Bearrer '+this.$root.token}
                }

                this.postEditar = await this.$axios.get("/api/post/slug/"+this.$route.params.slug, config)
                this.post = this.postEditar.data
            },
            
            initPost() {
                this.post.title = this.postEditar.title
                this.post.description = this.postEditar.description
                this.post.content = this.postEditar.content
                this.post.category_id = this.postEditar.category_id
                this.post.posted = this.postEditar.posted
            },
            submit() {
                // console.log(this.post)
                this.clearErrorsPosts()
                const config = {
                    headers: {Authorization: 'Bearrer '+this.$root.token}
                }

                if(this.postEditar == '')
                {
                    return this.$axios.post("/api/post",this.post, config).then(res =>{
                        this.$oruga.notification.open({
                        message: 'Registro Procesado con Exito',
                        position: 'bottom-right',
                        variant: 'success',
                        duration: 4000,
                        closable: true
                        });
                    }).catch(error => {
                        console.log(error.response.data)

                        if(error.response.data.title)
                            this.postError.title = error.response.data.title[0]
                        if(error.response.data.description)
                            this.postError.description = error.response.data.description[0]
                        if(error.response.data.content)
                            this.postError.content = error.response.data.content[0]
                        if(error.response.data.category_id)
                            this.postError.category_id = error.response.data.category_id[0]
                        if(error.response.data.posted)
                            this.postError.posted = error.response.data.posted[0]
                    })
                }  
                else {
                    //actualizar 
                    this.$axios.patch("/api/post/"+this.post.id,this.post,config).then(res =>{
                        this.$oruga.notification.open({
                        message: 'Registro actualizado con Exito',
                        position: 'bottom-right',
                        variant: 'success',
                        duration: 4000,
                        closable: true
                        });
                    }).catch(error => {
                        console.log(error.response.data)

                        if(error.response.data.title)
                            this.postError.title = error.response.data.title[0]
                        if(error.response.data.description)
                            this.postError.description = error.response.data.description[0]
                        if(error.response.data.content)
                            this.postError.content = error.response.data.content[0]
                        if(error.response.data.category_id)
                            this.postError.category_id = error.response.data.category_id[0]
                        if(error.response.data.posted)
                            this.postError.posted = error.response.data.posted[0]
                    })
                }
            }

        },
        watch: {
            filesDaD:{
                handler(val){
                    console.log(val[val.length-1])
                },
                deep:true
            }
        }
    }
</script>