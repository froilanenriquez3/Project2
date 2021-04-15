<template>
    <div id="incTableDiv">
        <table class="table">
            <thead>
                <tr>
                    <th>Incidencia ID</th>
                    <th>Data</th>
                    <th>Telefon Alertant</th>
                    <th>Adreca</th>
                    <th>Tipus Incidencia</th>
                    <th>Descripcio</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="incidencia in paginator(incidencies)" :key="incidencia.id">
                    <td>{{ incidencia.id }}</td>
                    <td>{{ incidencia.data}}</td>
                    <td>{{ incidencia.telefon_alertant}}</td>
                    <td>{{ incidencia.adreca }}</td>
                    <td>{{ incidencia.tipus_incidencia.tipus}}</td>
                    <td>{{ incidencia.descripcio.substring(0,20)}}</td>
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
                    console.log(me.incidencies);
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
                        // console.log("Select incidencies" + me.incRecs);

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
