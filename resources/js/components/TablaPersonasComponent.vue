<template>
    <transition name="fade">
        <tr>
            <th scope="row">{{indice+1}}</th>
            <td>
                <input v-if="editable" class="form-control mb-3" @keyup="validar($event)" v-model="persona.cedula" id="cedula">
                <span v-else>{{persona.cedula}}</span>
            </td>

            <td>
                <input v-if="editable" class="form-control mb-3" @keyup="validar($event)" v-model="persona.nombres" id="nombres">
                <span v-else>{{persona.nombres}}</span>
            </td>

            <td>
                <input v-if="editable" class="form-control mb-3" @keyup="validar($event)" v-model="persona.apellidos" id="apellidos">
                <span v-else>{{persona.apellidos}}</span>
            </td>

            <td>
                <textarea v-if="editable" class="form-control pb-3 mb-3" @keyup="validar($event)" name="direccion" v-model="persona.direccion" id="direccion"></textarea>
                <span v-else>{{persona.direccion}}</span>
            </td>

            <td>
                <input v-if="editable" class="form-control mb-3" @keyup="validar($event)" v-model="persona.edad" id="edad">
                <span v-else>{{persona.edad}}</span>
            </td>
            <td>
                <div class="mx-auto" style="width: 200px">
                    <button class="btn btn-secondary " v-if="!editable" @click="btnEditar()">Editar</button>
                    <button class="btn btn-dark " v-else-if="editable && !modificado" @click="cancelar()">Cancelar</button>
                    <button class="btn btn-success " v-else  @click="btnActualizar()">Salvar</button>

                    <button class="btn btn-danger " @click="btnEliminar()">Eliminar</button>

                </div>
            </td>  
        </tr>
    </transition>
</template>

<script>
    import Vue from 'vue';
    import VueAlertify from 'vue-alertify';

    Vue.use(VueAlertify, {
        glossary: {
        // dialogs default title
        title: '¡Atención!',
        // ok button text
        ok: 'Aceptar',
        // cancel button text
        cancel: 'Cancelar',
    },
});

    export default {
        props:['persona', 'indice'],
        data(){
            return {
                editable: false,
                modificado: false,
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
                var confirmacion = this.$alertify.confirm(
                    '¿Queieres eliminar el registo de <b>'+this.persona.nombres+' '+this.persona.apellidos+ '</b>?',
                    () => this.$alertify.success('ELiminado registro de<br>'+this.persona.nombres+' '+this.persona.apellidos, axios.delete(`/personas/${this.persona.id}`).then(()=>{
                       this.$emit('eliminar'); 
                   })),
                    //() => this.$alertify.error('cancel')
                    );
                
                
            },
            validar(e) { 
                /*
                let tecla = (document.all) ? e.keyCode : e.which;//solo funciona si se borran caracteres
                if (tecla==8) {
                    this.modificado = true;
                }*/
                this.modificado = true

            },
            cancelar(){
                this.editable = false;
            }  
        }
    }
</script>

<style type="text/scss">
    .fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
opacity: 0;
}


</style>