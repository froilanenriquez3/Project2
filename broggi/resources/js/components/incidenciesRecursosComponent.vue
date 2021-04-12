<template>
    <div class="container">
       <div id="incidenciesRecursosDiv">
           <div class="form-group row">
               <label class="col-2" for="">Hora Activacio</label>
               <input class="col-2" type="time">
           </div>

           <div class="form-group row">
               <label class="col-2" for="">Hora Mobilitzacio</label>
               <input class="col-2" type="time" >
           </div>

           <div class="form-group row">
               <label class="col-2" for="">Hora Assistencia</label>
               <input class="col-2" type="time">
           </div>

           <div class="form-group row">
               <label class="col-2" for="">Hora Transport</label>
               <input class="col-2" type="time">
           </div>

           <div class="form-group row">
               <label class="col-2" for="">Hora Arribada Hospital</label>
               <input class="col-2" type="time">
           </div>

           <div class="form-group row">
               <label class="col-2" for="">Hora Transferencia</label>
               <input class="col-2" type="time">
           </div>

           <div class="form-group row">
               <label class="col-2" for="">Hora Finalitzacio</label>
               <input class="col-2" type="time">
           </div>

       </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                incidencia: {
                    activacio: null,
                    mobilitzacio: null,
                    assistencia: null,
                    transport: null,
                    arribadaHospital: null,
                    transferencia: null,
                    finalitzacio: null
                }
            }
        },
        methods : {

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
