<template>
    <div class="container">
         <div v-show="action == 'afegir' || action == 'editar'">
            <div class="form-group row">
                <label class="col-2" for="codi">Codi</label>
                <input v-model="recurs.codi" class="col-10" type="text" id="codi" name="codi" />
            </div>
             <div class="form-group row">
            <label class="form-check-label col-2" for="actiu">Actiu</label>
            <div class="custom-control custom-checkbox col-10">
                <input class="form-check-input" type="checkbox"  v-model="recurs.actiu" value="actiu" name="actiu" id="actiu">
            </div>
        </div>
            <div class="form-group row">
            <label class="col-2" for="tipus_rescurs_id">Tipus</label>
            <select class="form-select" v-model="recurs.tipus_recursos_id" aria-label="Default select example">
                <option v-for="recurso in tipus_recursos" :key="recurso.id" :selected="recurso.id == recurs.tipus_recursos_id"
                v-bind:value="recurso.id" >{{recurso.tipus}}</option>
            </select>
            </div>


            <button v-if="action == 'afegir' " type="button" @click="afegirRecurs()" class="btn btn-primary">Afegir</button>
            <button v-else type="button" @click="editarRecurs()" class="btn btn-warning">Editar</button>
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
