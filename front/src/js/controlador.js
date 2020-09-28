import axios from 'axios'

function obtenerImagenes() {
    axios({
        method: 'GET',
        url: 'http://localhost/pruebavue/backend/index.php',
        responseType: 'json'
    }).then(res => {
        console.log(res);
    }).catch(error => {
        console.error(error);
    });
}

//const app = new Vue({
    export default {
    data: function () {
        return {
            cart: []
        }
    },

    computed: {
        cartAmount(){
            /*this.cart = JSON.parse(localStorage.getItem('nombre'));
            localStorage.setItem('nombre', JSON.stringify(this.cart));
            return this.cart.length;*/
        },

        AgregarCarrito(){
            alert('hola');
        }
    }
}
//})

obtenerImagenes();