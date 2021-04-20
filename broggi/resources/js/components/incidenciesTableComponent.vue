<template>
    <div id="incTableDiv">
        <!-- Filtro -->
        <filter-select :multiple="multiple" :name="'Tipus inciencia:'" :listToFilter="incidencies" :filterBy="tipusIncidencies" :filterField="'tipus'" :relatedId="'tipus_incidencies_id'"
        @applyFilterResults="filter($event)"></filter-select>
        <!-- Si no hay nada que cumpla con lo buscado, no sale la tabla y solo mostramos mensaje -->
        <div v-if="itemsToDisplay.length == 0"> No s'han trobat elements d'aquestes característiques</div>
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
                <tr v-for="incidencia in paginator(itemsToDisplay)" :key="incidencia.id">
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
    import FilterSelect from './filterSelect.vue';
    export default {
         components: { FilterSelect },
        data(){
            return {
                itemsToDisplay: [],
                perPage: 5,
                currentPage: 1,
                totalRows: '',
                incidencies: [],
                incidenciesRecursos: [],
                incRecs: [],
                tipusIncidencies: []
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
                    me.itemsToDisplay= me.incidencies;
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
            filter(itemsFiltered){
            this.itemsToDisplay= itemsFiltered;
            this.totalRows= this.itemsToDisplay.length;
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
            getTipusIncidencies(){
        let me = this;
      axios
        .get("/tipusincidencies")
        .then((response) => {
          console.log(response.data);
          me.tipusIncidencies = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    }
        },
        mounted() {
            // console.log('Component mounted.');
            this.selectIncidencies();
            this.getTipusIncidencies();
        }
    }
</script>
