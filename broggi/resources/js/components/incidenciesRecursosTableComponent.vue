<template>
    <div id="incRecTableDiv">
        <table class="table">
            <thead>
                <tr>
                    <th>Incidencia ID</th>
                    <th>Recurs ID</th>
                    <th>Recurs Codi</th>
                    <th>Afectat ID</th>
                    <th>Afectat Nom</th>
                    <th>Desti</th>
                    <th>Hora Activacio</th>
                    <th>Hora Finalitzacio</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="incidencia in paginator(incRecs)" :key="incidencia.id">
                    <td>{{ incidencia.incidencies_id }}</td>
                    <td>{{ incidencia.recursos_id }}</td>
                    <td>{{ incidencia.recursos.codi}}</td>
                    <td>{{ incidencia.afectat_id }}</td>
                    <td>{{ incidencia.afectats.nom}}</td>
                    <td>{{ incidencia.desti}}</td>
                    <td>{{ incidencia.hora_activacio}}</td>
                    <td>{{ incidencia.hora_finalitzacio}}</td>
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
</template>

<script>
    export default {
        data(){
            return {
                itemsToDisplay: [],
                perPage: 5,
                currentPage: 1,
                totalRows: '',
                incidencies: [],
                incidenciesRecursos: [],
                incRecs: []
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
        },
        mounted() {
            console.log('Component mounted.')
            this.selectIncidencies();
        }
    }
</script>
