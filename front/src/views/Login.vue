<br/>
<template>
   <div class="container-table">

      <table class="table">
         <thead class="thead-dark">
            <tr>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>

      <div class="container" id="appLogin">
      
         <div class="container">
            <div class="panel panel-primary">
               <div class="panel-body">
                  <div class="form-group">
                     <div class="col-sm-5">
                     <label class="control-label col-sm-2">Usuario:</label>
                        <input class="form-control" type="text" name="usuario">
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-5">
                     <label class="control-label col-sm-2">Password:</label>
                        <input class="form-control" type="password" name="pass">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-2">  </label>
                     <div class="col-sm-5">
                        <input type="button" id="btnLoguear" @click='getLogin();' value="Login" class="btn btn-primary">                      
                     </div>
                  </div>
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
               usuario: '',
               pass: ''
            }
        },
        mounted(){
            //this.getLogin();
        },
        methods: {
            getLogin(){
               axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
            axios
            .post('/pruebavue/rest/public/api/usuarios', {
               usuario: this.usuario,
               pass: this.pass
            })
               .then(response => {
                  console.log(response);
               })
                  .catch(e => console.log(e))
            },
        }      
   }
</script>