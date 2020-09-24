<template>
    <div class="container">
        <h1>Productos</h1>
        <div class="row">
            <div class="card col-md-4" v-for="todo in todos" :key="todo.id" style="width: 18rem;">
                <img class="card-img-top" :src="todo.imagen" alt="Card image cap" width="70px" heigth="70px">
                <div class="card-body">
                    
                    <h5 class="card-title">{{ todo.nombre }}</h5>
                    <p class="card-text">{{ todo.descripcion }}</p>
                    <p class="card-text">Modelo: {{ todo.modelo }}</p>
                    
                    <Modal :producto="todo">
                    </Modal>

                </div>
            </div>
        </div>
        <br/>

    </div>
</template>

<script>
import axios from 'axios'
import Modal from '../components/Modal.vue'
axios.defaults.headers.common.Accept = 'application/json'
   export default {
        name: 'producto',

        components: {
            Modal
        },
        
        data(){
            return {
                todos: null,
                id: 0,
                //carrito: [],
                todo: [],
                producto: [],
                
            }
        },
        mounted(){
            this.getProductos();
        },
        methods: {
            getProductos(){
                axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
            axios
            .get('/pruebavue/rest/public/api/productos')
                .then(response => {
                this.todos = response.data
                //console.log(response.data);
                })
                .catch(e => console.log(e))
            },

        }      
   }
</script>