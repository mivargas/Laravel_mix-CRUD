<template>
    <div class="card">
     <h3 class="card-header progress-bar-striped bg-dark text-white text-center font-weight-bold">Registro de Personas</h3>

     <div class="card-body">
        <form v-on:submit.prevent="nuevaPersona">
           <p v-if="errors.length">
            <b class="text-danger">Por favor complete los siguientes campos:</b>
            <ul>
              <li v-for="error in errors">{{ error }}</li>
          </ul>
      </p>

      <label for="cedula">Cédula:</label>
      <input class="form-control mb-3" name="cedula" v-model="cedula" id="cedula">

      <label for="nombres">Nombres:</label>
      <input class="form-control mb-3" name="nombres" v-model="nombres" id="nombres">

      <label for="apellidos">Apellidos:</label>
      <input class="form-control mb-3" name="apellidos" v-model="apellidos" id="apellidos">

      <label for="direccion">Dirección:</label>
      <textarea class="form-control pb-3 mb-3" name="direccion" v-model="direccion" id="direccion"></textarea>

      <label for="edad">Edad:</label>
      <input class="form-control mb-3" name="edad" v-model="edad" id="edad">
      <div class="mx-auto" style="width: 200px">
        <button class="btn btn-primary mx-auto" style="width: 200px">Guardar</button>
    </div>
</form>    
</div>
</div>
</template>

<script>
    export default {
        data(){
            return {
                cedula: '',
                nombres: '',
                apellidos:'',
                direccion:'',
                edad:'',
                errors:[]

            }

        },
        mounted() {
            console.log('Component mounted.')
        },

        methods:{

            nuevaPersona(){

                if (this.cedula && this.nombres && this.apellidos && this.direccion && this.edad) {
                    /*
                    let persona = {
                        id:3,
                        cedula: this.cedula,
                        nombres: this.nombres,
                        apellidos: this.apellidos,
                        direccion: this.direccion,
                        edad: this.edad
                    }*/
                    const params = {
                        cedula: this.cedula,
                        nombres: this.nombres,
                        apellidos: this.apellidos,
                        direccion: this.direccion,
                        edad: this.edad
                    }
                    axios.post('/personas', params).then((response)=>{
                        let persona = response.data;
                        this.$emit('nuevo', persona);
                        this.cedula='';
                        this.nombres='';
                        this.apellidos='';
                        this.direccion='';
                        this.edad='';
                    });
                    
                    
                }

                this.errors = [];

                if (!this.cedula) {

                    this.errors.push('Cédula.');
                }
                if (!this.nombres) {
                    this.errors.push('Nombres.');
                }
                if (!this.apellidos) {
                    this.errors.push('Apellidos.');
                }
                if (!this.direccion) {
                    this.errors.push('Dirección.');
                }
                if (!this.edad) {
                    this.errors.push('Edad.');
                }
                
            }
        }
    }
</script>
