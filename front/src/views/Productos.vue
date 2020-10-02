<template>
    <div class="container" id="sProductos">
        <h1>Productos</h1>
        
        <div class="row">
            <div class="card col-md-4 offset-md-1" v-for="todo in todos" :key="todo.id" style="width: 18rem;">
                <img class="card-img-top" :src="todo.imagen"   height="200px">
                <div class="card-body">
        
                    <h5 class="card-title">{{ todo.nombre }}</h5>
                    <p class="card-text">{{ todo.descripcion }}</p>
                    <p class="card-text">Modelo: <br/>{{ todo.modelo }}</p>
                    <label id="idProducto" hidden>{{ todo.id }}</label>
                    
                    <!--<Modal :producto="todo" :id="id">
                    </Modal>-->
                    <button id="btnModal" @click="getProductoId2(todo)"  type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        Producto
                    </button>

                </div>
            </div>
        </div>
        <br/>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal de productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" v-for="produc in todo" :key="produc.id">
                
                    <div class="form-group">
                        <label id="idProducto" hidden>{{ produc.id }}</label>
                        <img img width="150px" height="150px" :src="produc.imagen">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre: {{ produc.nombre }}</label>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Precio: {{ produc.precio }}</label>
                    </div>
                    <div class="form-group">
                        <label id="modelo" for="recipient-name" class="col-form-label">Modelo: {{ produc.modelo }}</label>
                    </div>
                    <div class="form-group" id="aumentar">
                        <select v-model="contador" id="cantidadProducto">
                            <option disabled value="">Seleccione una cantidad</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                
                <button type="button" id="agregarCarrito" @click="AgregarCarrito2(produc,contador)" class="btn btn-primary">Agregar al Carrito</button>
               
            </div>
            <div class="modal-footer">
                <button id="cerrar" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

    </div>
</template>

<style>
    .col-md-4{
      cursor: pointer;
    }

    .col-md-4:hover {
        border: 1px solid #333;
    }
</style>

<script>
import axios from 'axios'
axios.defaults.headers.common.Accept = 'application/json'
   export default {
        name: 'producto',
        
        data(){
            return {
                idP: '',
                todos: null,
                todo: [],
                carrito: [],
                producto: [],
                contador: 0
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
            
            getProductoId2(todo){
                let id = todo.id
                axios
                .get('/pruebavue/rest/public/api/productos/'+id)
                .then(response => {
                    this.todo = response.data
                })
                .catch(e => console.log(e))
            },

            AgregarCarrito2(produc,contador){
        
                produc.numero = contador;
                //console.log(produc);
                if(localStorage.getItem('nombre') === null){
                    this.carrito.push(produc);
                    localStorage.setItem("nombre", JSON.stringify(this.carrito));
                    alert('Agregado al carrito');
                }else {
                    this.carrito = JSON.parse(localStorage.getItem("nombre"));
                        
                    for (let i= 0; i < this.carrito.length; i++) {
                        if (this.carrito[i]["id"] == produc.id) { 
                            console.log("son iguales");
                            this.carrito[i]["numero"]=Number(this.carrito[i]["numero"])+Number(contador);
                            localStorage.setItem("nombre", JSON.stringify(this.carrito));
                            return;
                        }
                    }

                    this.carrito.push(produc);
                    localStorage.setItem("nombre", JSON.stringify(this.carrito));
                    alert('Agregado al carrito');
                    return;
                }
            },
        
        }      
   }
</script>