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

            AgregarCarrito2(producto){
                this.carrito.push(producto)
                localStorage.setItem("nombre", JSON.stringify(producto));
                let m = this.carrito;
                console.log(m);
            },
            
        }      
   }