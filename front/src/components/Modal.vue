<template>
    <div>

    <!--<button @click="getProductoId2(producto)"  type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
        Producto {{ producto.nombre }}
    </button>

        <!-- Modal 
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
                <!--<form>
                    <input type="hidden" :value="produc.id">
                    <div class="form-group">
                        <img img width="60px" heigth="60px" :src="produc.imagen">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre: {{ produc.nombre }}</label>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Precio: {{ produc.precio }}</label>
                    </div>
                    <div class="form-group" id="aumentar">
                        <label for="recipient-name" class="col-form-label">Cantidad: {{ contador.numero }}</label>
                        <button @click="aumentar()" class="btn btn-primary"> + </button> 
                        <button @click="disminuir()" class="btn btn-primary"> - </button>
                    </div>
                <button type="button" @click="AgregarCarrito2(produc,contador)" class="btn btn-primary">Agregar al Carrito</button>
                <!--</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>-->

    </div>
</template>

<script>
import jquery from 'jquery'
import axios from 'axios'
axios.defaults.headers.common.Accept = 'application/json'
   export default {
        name: 'Modal',

        props: ['producto'], 

        data(){
            return {
                id: 0,
                carrito: [],
                todo: [],
                contador: { numero: 0 }
            }
        },
        methods: {
            getProductoId2(todo){
                let id = todo.id
                console.log(id);
            axios
            .get('/pruebavue/rest/public/api/productos/'+id)
                .then(response => {
                    console.log(response);
                    this.todo = response.data
                })
                .catch(e => console.log(e))
            },

            AgregarCarrito2(producto,contador){

                if(localStorage.getItem('nombre') === null){
                    this.carrito.push(producto)
                    localStorage.setItem("nombre", JSON.stringify(this.carrito));
                    alert('Agregado al carrito');
                }else{
                    let idp = JSON.parse(localStorage.getItem('nombre'));

                    for(var i=0; i<this.carrito.length; i++){
                        if(idp[i] != idp[i]){
                            this.carrito.push(producto); 
                            localStorage.setItem('nombre', JSON.stringify(this.carrito));
                            alert('Agregado al carrito');
                            console.log(contador);
                            
                        }else{
                            console.log('NO puedes agregar el mismo ID');
                        }
                    }
                    
                    /*this.carrito.push(producto); 
                    localStorage.setItem('nombre', JSON.stringify(this.carrito));
                    alert('Agregado al carrito');*/
                }


                //p = JSON.parse(localStorage.getItem('nombre'));
                //p.push(p)
                //let m = this.carrito;
                //console.log(m);
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

            mostrar(producto){
                jquery('#'+'producto'+producto.id).modal("show");
            }

        },   
   }
</script>