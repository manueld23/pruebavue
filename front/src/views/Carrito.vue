<template>
    <div>
        <h1>Carrito</h1>
        <div class="container-table">
            <table class="table table-light table-bordered">
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
                        <th><button @click="eliminarFila(car)" class="btn btn-danger">Eliminar</button></th>
                    </tr>
                    <tr>
                        <td colspan="3" align="right"><h3>Total</h3></td>
                        <td align="right"><h3>{{ total }}</h3></td>
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
                subtotal: 0,
                carrit: []
            }
        },
        mounted(){
            this.getCarrito();
        },
        computed: {
            total(){
                return this.carrit.reduce((acumulador, item) => acumulador + Number(item.precio)*Number(item.numero),0);
            }
        },
        methods: {
            getCarrito(){
                //this.carrit = JSON.parse(localStorage.getItem('nombre'));
                //this.carrit = localStorage.getItem("nombre");
                //let car = JSON.parse(localStorage.carrit);
                //console.log(this.carrit);
                //if(localStorage.getItem('nombre') === null) {
                    //this.carrit = [];
                //} else {
                    this.carrit = JSON.parse(localStorage.getItem('nombre'));
                    console.log(this.carrit);
                    //console.log(this.subtotal);
                //}
                //return this.carri
                
                //console.log(vector);*/
            },

            eliminarFila(car){
                var indice = this.carrit.indexOf(car);
                if(indice != -1){
                    this.carrit.splice(indice, 1);
                    localStorage.setItem('nombre', JSON.stringify(this.carrit));
                }
            }

            
        }      
   }
</script>