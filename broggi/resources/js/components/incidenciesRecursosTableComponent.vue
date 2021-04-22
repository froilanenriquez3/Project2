<template>
    <div id="incRecTableDiv">
        <div v-show="incRecs.length > 0">
            <table class="table">
            <thead>
                <tr>
                    <th>Incidència ID</th>
                    <th>Recurs Codi</th>
                    <th>Afectat ID</th>
                    <th>Afectat Nom</th>
                    <th>Desti</th>
                    <th>Hora Activació</th>
                    <th>Hora Finalització</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="incidencia in paginator(incRecs)" :key="incidencia.id">
                    <td>{{ incidencia.incidencies_id }}</td>
                    <td>{{ incidencia.recursos.codi}}</td>
                    <td>{{ incidencia.afectat_id }}</td>
                    <td>{{ incidencia.afectats.nom}}</td>
                    <td>{{ incidencia.desti}}</td>
                    <td>{{ incidencia.hora_activacio}}</td>
                    <td>{{ incidencia.hora_finalitzacio}}</td>
                    <td>
                        <a :href="'http://localhost:8080/Project2/broggi/public/incidenciesrecursos/'+ incidencia.incidencies_id + '/edit'">
                            <button class="btn btn-warning">Editar</button>
                        </a>
                    </td>
                    <td> <button class="btn btn-secondary" @click="confirmDelete(incidencia)">Esborrar</button> </td>
                </tr>
            </tbody>
        </table>
         <b-pagination
            v-model="currentPage"
            :total-rows="totalRows"
            :per-page="perPage"
            aria-controls="my-table">
        </b-pagination>
        </div>
        <p v-show="incRecs.length == 0">No hi ha incidències</p>


            <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Esborrar incidència</h5>
                <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modalText" class="modal-body">
                Està segur d'esborrar l'incidència {{ editIncidencia.id }} ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Tancar
                </button>
                <button id="buttonDeleteModal" @click="deleteIncidencia()" type="submit"
                class="btn btn-secondary">
                    Esborrar
                </button>
            </div>
        </div>
      </div>
    </div>
    </div>
</template>

<script>
    export default {
         props : {
            userrecursoid: {
                required: true,
                type: Number

            }
        },
        data(){
            return {
                itemsToDisplay: [],
                perPage: 5,
                currentPage: 1,
                totalRows: '',
                incidencies: [],
                incidenciesRecursos: [],
                incRecs: [],
                editIncidencia:{
                    id: null
                }
            }
        },
        methods : {
            paginator(incidencies){
                const beginning = (this.currentPage - 1) * this.perPage;
                const end =
                beginning + this.perPage > incidencies.length
                    ? incidencies.length
                    : beginning  + this.perPage;
                return incidencies.slice(beginning , end );
            },
            selectIncidencies(){
                let me = this;
                axios
                    .get("/incidencies")
                    .then((response) => {
                    me.incidencies = response.data;

                    /* response.data.forEach(incidencia => {
                        incidencia.incidencies_has_recursos.forEach( i =>{
                             me.incRecs.push(i);
                        });
                    }); */

                    me.incidencies.forEach( incidencia =>{
                        me.showIncidenciaRecurso(incidencia.id);
                    });

                    })
                    .catch((error) => {
                    console.log(error);
                    })
                    .finally(() => {
                        this.loading = false;
                        console.log("Select incidencies" + me.incRecs);

                    });

                this.totalRows = this.incidencies.length;
            },
             showIncidenciaRecurso(id){
                let me = this;
                axios
                    .get("/incidencies/" + id)
                    .then((response) => {
                        // console.log(response.data);
                        me.incidencia = response.data;
                        me.incidencia.incidencies_has_recursos.forEach(i => {
                            if(i.recursos.id == me.userrecursoid)
                            me.incRecs.push(i);
                        });
                        me.itemsToDisplay= me.incRecs;
                        me.totalRows= me.itemsToDisplay.length;
                    })
                    .catch((error) => {
                    console.log(error);
                    })
                    .finally(() => {
                        this.loading = false;
                        // console.log(me.incidencia);
                    });

            },
            deleteIncidencia(){
                let me = this;
                axios
                    .delete("/incidenciesrecursos/" + me.editIncidencia.id)
                    .then(response => {
                        console.log(response.data);
                        me.incRecs = [];
                        me.incidencies = [];
                        me.editIncidencia = {
                            id: null
                        };

                         me.selectIncidencies();

                    })
                    .catch(error => {
                        console.log(error.response.data);
                    })
                    .finally(()=> {
                        $("#deleteModal").modal("hide");
                    });
            },
            confirmDelete(incRec){
                let found = false;
                let i = 0;
                do{
                    if (this.incidencies[i].id == incRec.incidencies_id){
                        this.editIncidencia = this.incidencies[i];
                         found = true;
                    }
                    i++;
                }while(i < this.incidencies.length && !found);


                console.log(this.editIncidencia);
                $("#deleteModal").modal("show");
            }
        },
        mounted() {
            // console.log('Component mounted.');
            this.selectIncidencies();
        }
    }
</script>
<style scoped>
    a {
        text-decoration: none;
        color: black
    }
</style>
