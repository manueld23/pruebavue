<template>
    <div class="container">
        <h1>Productos</h1>
        <div class="row">
            <div class="card col-md-4" v-for="todo in todos" :key="todo.id" style="width: 18rem;">
                <img class="card-img-top" :src="todo.imagen" alt="Card image cap" width="70px" heigth="70px">
                <div class="card-body">
                    <input type="hidden" :value="todo.id">
                    <h5 class="card-title">{{ todo.nombre }}</h5>
                    <p class="card-text">{{ todo.descripcion }}</p>
                    <p class="card-text">Modelo: {{ todo.modelo }}</p>
                    <button @click="AgregarCarrito()" class="btn btn-primary">Agregar al Carrito</button>
                    <button @click="getProductoId(todo)" class="btn btn-primary">Ver</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../js/controlador.js"></script>

<script>
  import axios from 'axios'

   export default {
        data(){
            return {
                todos: null,
                id: 0,
                carrito: []
            }
        },
        mounted(){
            this.getImagenes();
            this.AgregarCarrito();
            //this.getProductoId();
        },
        methods: {
            getImagenes(){
            axios
            .get('http://localhost/pruebavue/rest/public/api/productos')
                .then(response => {
                this.todos = response.data
                })
                .catch(e => console.log(e))
            },
            getProductoId(todo){
                let id = todo.id
                //console.log(id);
            axios
            .get('http://localhost/pruebavue/rest/public/api/productos/'+id)
                .then(response => {
                    console.log(response);
                    //this.id = response.id
                })
                .catch(e => console.log(e))
            },
            
            AgregarCarrito(){
                this.carrito.push(this.getProductoId)
                /*this.carrito.push(this.getProductoId);
                let m = this.carrito;
                console.log(m);*/
            }
        }      
   }
</script>