<br/>
<template>
   <div class="container-table">
      <table class="table">
         <thead class="thead-dark">
            <tr>
               <th scope="col">Titulo</th>
               <th scope="col">Imagen</th>
               <th scope="col">Noticia</th>
               <th scope="col">Acciones</th>
            </tr>
         </thead>
         <tbody>
            <tr v-for="todo in todos" :key="todo.id">
               <td>{{ todo.titulo }}</td>
               <td><img :src="todo.imagen" width="60" height="60"></td>
               <td>{{ todo.noticia }}</td>
               <td>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#editarImagen">Editar</button>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#eliminarImagen">Eliminar</button>
               </td>
            </tr>
         </tbody>
      </table>

      <!-- Modal -->
      <div class="modal fade" id="editarImagen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Editar imagen</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               </div>
               <div class="modal-body">
                  <form method="post">
                     <div class="form-group">
                        <label for="exampleInputTitulo">Titulo</label>
                        <input type="text" name="titulo" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputImagen">Imagen</label>
                        <input type="text" name="imagen" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputNoticia">Noticia</label>
                        <input type="text" name="noticia" class="form-control">
                     </div>
                  </form>
               </div>
               <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               <button type="button" class="btn btn-primary">Guardar cambios</button>
               </div>
            </div>
         </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="eliminarImagen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro de eliminar el registro?</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               </div>
               <div class="modal-body">
               ...
               </div>
               <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               <button type="button" class="btn btn-danger">Si</button>
               </div>
            </div>
         </div>
      </div>

   </div>
</template>

<style>
   .container-table{
      padding: 70px;
   }
</style>

<script>
  import axios from 'axios'

   export default {
      data(){
         return {
            todos: null,
            titulo: '',
            imagen: '',
            noticia: ''
         }
      },
      mounted(){
        this.getImagenes();
      },
      methods: {
         getImagenes(){
         axios
         .get('http://localhost/pruebavue/backend/index.php')
            .then(response => {
               this.todos = response.data
            })
            .catch(e => console.log(e))
         },

         insertImagenes(){
            axios
            .post('http://localhost/pruebavue/backend/index.php', {
               titulo: this.titulo,
               imagen: this.imagen,
               noticia: this.noticia
            })
            .then(response => {
               console.log(response);
            })
            .catch(e => console.log(e))
         }

      }      
   }
</script>