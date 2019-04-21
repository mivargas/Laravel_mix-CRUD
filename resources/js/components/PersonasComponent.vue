<template>
    <div class="card">
     <div class="card-header progress-bar-striped bg-dark text-white text-center font-weight-bold">Persona</div>

     <div class="card-body">
        <label for="cedula">Cédula:</label>
        <input v-if="editable" class="form-control mb-3"  v-model="persona.cedula" id="cedula">
        <p v-else>{{persona.cedula}}</p>

        <label for="nombres">Nombres:</label>
        <input v-if="editable" class="form-control mb-3"  v-model="persona.nombres" id="nombres">
        <p v-else>{{persona.nombres}}</p>

        <label for="apellidos">Apellidos:</label>
        <input v-if="editable" class="form-control mb-3"  v-model="persona.apellidos" id="apellidos">
        <p v-else>{{persona.apellidos}}</p>

        <label for="direccion">Dirección:</label>
        <textarea v-if="editable" class="form-control pb-3 mb-3" name="direccion" v-model="persona.direccion" id="direccion"></textarea>
        <p v-else>{{persona.direccion}}</p>

        <label for="edad">Edad:</label>
        <input v-if="editable" class="form-control mb-3"  v-model="persona.edad" id="edad">
        <p v-else>{{persona.edad}}</p>
        <div class="mx-auto" style="width: 200px">
            <button class="btn btn-dark " v-if="!editable" @click="btnEditar()">Editar</button>
            <button class="btn btn-success " v-else @click="btnActualizar()">Salvar</button>
            <button class="btn btn-danger " @click="btnEliminar()">Eliminar</button>
        </div>  
    </div>
</div>
</template>

<script>
    export default {
        props:['persona'],
        data(){
            return {
                editable: false
            }

        },
        mounted() {
            console.log('Component mounted.')
        },

        methods:{
            btnEditar(){
                this.editable =true;
            },
            btnActualizar(){
                const params = {
                    cedula: this.persona.cedula,
                    nombres: this.persona.nombres,
                    apellidos: this.persona.apellidos,
                    direccion: this.persona.direccion,
                    edad: this.persona.edad
                }
                axios.put(`/personas/${this.persona.id}`, params).then((response)=>{
                    this.editable =false;
                })
                
            },

            btnEliminar(){
                if(confirm("¿Queieres eliminar  este registo?")){
                    axios.delete(`/personas/${this.persona.id}`).then(()=>{
                     this.$emit('eliminar'); 
                 });
                }
                
            }
        }
    }
</script>
