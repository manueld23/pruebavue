import Productos from '../views/Productos.vue'
import App from '../../App.vue'
import axios from 'axios'

axios.defaults.headers.common.Accept = 'application/json'
   export default {
        data(){
            return {
                todos: null,
                id: 0,
                carrito: []
            }
        },
        mounted(){
            this.getProductos();
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

            getProductoId(todo){
                let id = todo.id
                //console.log(id);
            axios
            .get('/pruebavue/rest/public/api/productos/'+id)
                .then(response => {
                    console.log(response);
                    //this.id = response.id
                })
                .catch(e => console.log(e))
            },
            
            AgregarCarrito(todo){
                //alert('hola');
                this.carrito.push(todo)
                let m = this.carrito;
                console.log(m);
            }
        }      
   }