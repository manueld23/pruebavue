<template>
    <div>
        <h1>Carrito</h1>
        <div class="container-table">
            <table class="table table-light table-bordered">
                <tbody>
                    <tr>
                        <th width="40%">Descripcion</th>
                        <th width="15%">Cantidad</th>
                        <th width="20%">Precio</th>
                        <th width="20%">Total</th>
                        <th width="5%">Descripcion</th>
                    </tr>
                    <tr v-for="car in carrit" :key="car.id">
                        <th>{{ car }}</th>
                        <th>{{ car }}</th>
                        <th>{{ car }}</th>
                        <th></th>
                        <th><button class="btn btn-danger">Eliminar</button></th>
                    </tr>
                    <tr>
                        <td colspan="3" align="right"><h3>Total</h3></td>
                        <td align="right"><h3>$7000</h3></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
</template>

<script>
import axios from 'axios'
axios.defaults.headers.common.Accept = 'application/json'
   export default {
        data(){
            return {
                carrit: []
            }
        },
        mounted(){
            this.getCarrito();
        },
        methods: {
            getCarrito(){
                this.carrit = JSON.parse(localStorage.getItem('nombre'));
                //this.carrit = localStorage.getItem("nombre");
                //let car = JSON.parse(localStorage.carrit);
                console.log(this.carrit);
            }
            
        }      
   }
</script>