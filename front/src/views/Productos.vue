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
                    <!--<button @click="getProductoId(todo)" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">modal</button>-->
                    <button @click="getProductoId2(todo)" type="button" class="btn btn-success" 
                     data-toggle="modal" data-target="#prueba">Producto</button>
                    <!--<button type="button" @click="AgregarCarrito(todo)" class="btn btn-primary">Agregar al Carrito</button>-->
                </div>
            </div>
        </div>
        <br/>

        <!-- Modal -->
        <div class="modal fade" id="prueba" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" v-for="prod in producto" :key="prod.id">
                <!--<form>-->
                    <input type="hidden" :value="prod.id">
                    <div class="form-group">
                        <img img width="60px" heigth="60px" :src="prod.imagen">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre: {{ prod.nombre }}</label>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Precio: {{ prod.precio }}</label>
                    </div>
                    <div class="form-group" id="aumentar">
                        <label for="recipient-name" class="col-form-label">Cantidad: {{ contador.numero }}</label>
                        <button @click="aumentar()" class="btn btn-primary"> + </button> 
                        <button @click="disminuir()" class="btn btn-primary"> - </button>
                    </div>
                <button type="button" @click="AgregarCarrito2(prod)" class="btn btn-primary">Agregar al Carrito</button>
                <!--</form>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

        <!-- Modal
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" v-for="prod in todo" :key="prod.id">
                <form>
                    <input type="text" :value="prod.id">
                    <div class="form-group">
                        <img img width="60px" heigth="60px" :src="prod.imagen">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre: {{ prod.nombre }}</label>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Precio: {{ prod.precio }}</label>
                    </div>
                    <div class="form-group" id="aumentar">
                        <label for="recipient-name" class="col-form-label">Cantidad: {{ contador.numero }}</label>
                        <button @click="aumentar()" class="btn btn-primary"> + </button> 
                        <button @click="disminuir()" class="btn btn-primary"> - </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" @click="AgregarCarrito(todo)" class="btn btn-primary">Agregar al Carrito</button>
            </div>
            </div>
        </div>
        </div>-->
        
        <table class="table table-ligh table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>imagen</th>
                    <th>Total</th>
                    <th>- -</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cart in carrito" :key="cart.id">
                    <th>{{ cart.nombre }}</th>
                    <th>{{ cart.cantidad }}</th>
                    <th>{{ cart.precio}}</th>
                    <th><img width="50px" heigth="50px" :src="cart.imagen"></th>
                    <th>{{ cart.cantidad*cart.precio }}</th>
                    <th><button class="btn btn-danger">Eliminar</button></th>
                    <input type="hidden" :value="total = total+(cart.cantidad*cart.precio)">
                </tr>
                <tr>
                    <td colspan="4" align="right"><h3>Total</h3></td>
                    <td align="right"><h3>{{ total }}</h3></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script src="../js/productos.js"></script>
<script src="../js/controlador.js"></script>

<script>
import axios from 'axios'
axios.defaults.headers.common.Accept = 'application/json'
   export default {
        data(){
            return {
                total: 0,
                todos: null,
                id: 0,
                carrito: [],
                todo: [],
                producto: [],
                contador: { numero: 0 }
            }
        },
        mounted(){
            this.getProductos();
            this.aumentar();
            //this.AgregarCarrito();
            //this.getProductoId();
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

            /*getProductoId(todo){
                let id = todo.id
                //console.log(id);
            axios
            .get('/pruebavue/rest/public/api/productos/'+id)
                .then(response => {
                    console.log(response);
                    this.todo = response.data
                })
                .catch(e => console.log(e))
            },
            
            AgregarCarrito(todo){
                this.carrito.push(todo)
                let m = this.carrito;
                console.log(m);
            },*/


            getProductoId2(todo){
                let id = todo.id
                //console.log(id);
            axios
            .get('/pruebavue/rest/public/api/productos/'+id)
                .then(response => {
                    console.log(response);
                    this.producto = response.data
                })
                .catch(e => console.log(e))
            },
            
            AgregarCarrito2(prod){
                this.carrito.push(prod)
                let m = this.carrito;
                console.log(m);
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
            }

        }      
   }
</script>