<template>
    <div>
        <!-- Modal -->
        <div id="modalMostrar" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1>Modal</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
axios.defaults.headers.common.Accept = 'application/json'
   export default {
        data(){
            return {
                id: 0,
                carrito: []
            }
        },
        methods: {
            AgregarCarrito(todo){
                this.carrito.push(todo)
                let m = this.carrito;
                console.log(m);
            }

        }      
   }
</script>