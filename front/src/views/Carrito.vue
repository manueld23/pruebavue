<template>
    <div id="sCarrito">
        <h1>Carrito prueba 2 del commit</h1>
        <div class="container-table" v-if="carrit != 0">
            <table class="table table-light table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="40%">Descripcion</th>
                        <th width="15%">Cantidad</th>
                        <th width="20%">Precio</th>
                        <th width="20%">Total</th>
                        <th width="5%">Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="car in carrit" :key="car.id">
                        <th>{{ car.nombre }}</th>
                        <th>{{ car.numero }}</th>
                        <th>{{ car.precio }}</th>
                        <td> {{car.precio*car.numero}}</td>
                        <th><button @click="eliminarFila(car)" class="btn btn-danger" id="btnEliminarP">Eliminar</button></th>
                    </tr>
                    <tr>
                        <td colspan="3" align="right"><h3>Total</h3></td>
                        <td align="right"><h3>{{ total }}</h3></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><button id="btnComprar" @click="comprar()" class="btn btn-success">Comprar</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-else>
            <h3>No hay productos seleccionados</h3>
        </div>
        
    </div>
</template>

<style>
    .table-bordered{
       border: 1px solid #333;
    }
</style>

<script>
import axios from 'axios'
axios.defaults.headers.common.Accept = 'application/json'
   export default {

        data(){
            return {
                subtotal: 0,
                carrit: []
            }
        },
        mounted(){
            this.getCarrito();
        },
        computed: {
            total(){
                if(this.carrit.reduce == null){
                 alert('esta vacio');
                }
                return this.carrit.reduce((acumulador, item) => acumulador + Number(item.precio)*Number(item.numero),0);
            }
        },
        methods: {
            getCarrito(){ 
                this.carrit = JSON.parse(localStorage.getItem('nombre'));
                console.log(this.carrit);
            },

            eliminarFila(car){
                var indice = this.carrit.indexOf(car);
                if(indice != -1){
                    this.carrit.splice(indice, 1);
                    localStorage.setItem('nombre', JSON.stringify(this.carrit));
                }
            },

            comprar(){
                alert('COMPRA EXITOSA');
            }
            
        }      
   }
</script>