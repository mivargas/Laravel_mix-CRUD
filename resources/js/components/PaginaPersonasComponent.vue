<template>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <formulario-personas-component class="mb-3"  @nuevo="agregarPersona"></formulario-personas-component>
            <!--personas-component class="mb-3" :persona="persona" v-for="(persona, index) in personas" :key="persona.id" @eliminar="eliminarPersona(index)" ></personas-->
            
            
        </div>
        <transition name="slide-fade">
            <table class="table table-striped" v-if="show">
                <thead class="text-center">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Cédula</th>
                      <th scope="col">Nombres</th>
                      <th scope="col">Apellidos</th>
                      <th scope="col">Dirección</th>
                      <th scope="col">Edad</th>
                      <th scope="col">Opc.</th>
                  </tr>
              </thead>
              <tbody class="text-center">
                <tabla-personas-component :indice="index" :persona="persona" v-for="(persona, index) in personas" :key="persona.id" @eliminar="eliminarPersona(index)" ></tabla-personas-component>
            </tbody>
        </table>
    </transition>

</div>


</template>

<script>
    export default {
        data(){
            return {
                personas:[],
                show: false
            }
        },
        mounted() {
            //console.log('Component mounted.')
            axios.get('personas/').then((response)=>{
                this.personas = response.data;
            });
            
            setTimeout( () => this.show = true, // mostrar tabla
            1000 // despues de 1 segunddo
            )
        },

        methods:{
            agregarPersona(persona){
                
                this.personas.push(persona);
            },
            eliminarPersona(index){
                this.personas.splice(index, 1);
            }
        }
    }
</script>
<style type="text/css">
.slide-fade-enter-active {
  transition: all .9s ease;
}

.slide-fade-leave-active {
  transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}

.slide-fade-enter,.slide-fade-leave-active {
  padding-left: 10px;
  opacity: 0;
}
</style>