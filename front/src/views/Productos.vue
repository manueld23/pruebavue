<template>
    <div class="container" id="sProductos">
        <h1>Productos</h1>
        <div class="row">
            <div class="card col-md-4 offset-md-1" v-for="todo in todos" :key="todo.id" style="width: 18rem;">
                <img class="card-img-top" :src="todo.imagen"  width="70px" heigth="70px">
                <div class="card-body">
        
                    <h5 class="card-title">{{ todo.nombre }}</h5>
                    <p class="card-text">{{ todo.descripcion }}</p>
                    <p class="card-text">Modelo: {{ todo.modelo }}</p>
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
                <h5 class="modal-title" id="exampleModalLabel">Modal De productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" v-for="produc in todo" :key="produc.id">
                <!--<form>-->
                    <div class="form-group">
                    <label id="idProducto">{{ produc.id }}</label>
                        <img img width="60px" heigth="60px" :src="produc.imagen">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre: {{ produc.nombre }}</label>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Precio: {{ produc.precio }}</label>
                    </div>
                    <div class="form-group" id="aumentar">
                        <select v-model="contador" id="cantidadProducto">
                            <option disabled value="">Seleccione una cantidad</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                        <!--<label for="recipient-name" class="col-form-label">Cantidad: {{ contador.numero }}</label>
                        <button @click="aumentar()" class="btn btn-primary"> + </button> 
                        <button @click="disminuir()" class="btn btn-primary"> - </button>-->
                    </div>
                
                <!--<Carrito :producto="produc">
                </Carrito>-->
                <button type="button" id="agregarCarrito" @click="AgregarCarrito2(produc,contador)" class="btn btn-primary">Agregar al Carrito</button>
                <!--</form>-->
            </div>
            <div class="modal-footer">
                <button id="cerrar" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios'
//import Carrito from '../components/Carrito.vue'
axios.defaults.headers.common.Accept = 'application/json'
   export default {
        name: 'producto',

        /*components: {
            Carrito
        },*/
        
        data(){
            return {
                idP: '',
                todos: null,
                //id: 0,
                //carrito: [],
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
                //console.log(id);
            axios
            .get('/pruebavue/rest/public/api/productos/'+id)
                .then(response => {
                    //console.log(response);
                    this.todo = response.data
                })
                .catch(e => console.log(e))
            },

            aumentar(){
                this.contador.numero++
            },

            disminuir(){
                if(this.contador == 0){
                 this.contador = 1
                }else{
                    if(this.contador.numero-- == 0){
                        this.contador = 1
                    }
                }
            },

            AgregarCarrito2(produc,contador){
        
            produc.numero = contador;
             //console.log(produc);
                if(localStorage.getItem('nombre') === null){
                    this.carrito.push(produc);
                    localStorage.setItem("nombre", JSON.stringify(this.carrito));
                    //alert('Agregado al carrito');
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
                    return;
                    
                }/*else{
                        
                }*/
            },
        
        }      
   }
</script>