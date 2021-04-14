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
                </tr>
            </thead>
            <tbody>
                <tr v-for="incidencia in paginator(incRecs)" :key="incidencia.id">
                    <td>{{ incidencia.incidencies_id }}</td>
                    <td>{{ incidencia.recursos_id }}</td>
                    <td></td>
                    <td>{{ incidencia.afectat_id }}</td>
                    <td></td>
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

                    response.data.forEach(incidencia => {
                        incidencia.incidencies_has_recursos.forEach( i =>{
                             me.incRecs.push(i);
                        });
                    });

                    })
                    .catch((error) => {
                    console.log(error);
                    })
                    .finally(() => {
                        this.loading = false;
                        console.log(me.incRecs);
                        me.itemsToDisplay= me.incRecs;
                        me.totalRows= me.itemsToDisplay.length;
                    });

                this.totalRows = this.incidencies.length;
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.selectIncidencies();
        }
    }
</script>
