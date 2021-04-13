<template>
    <div id="incRecTableDiv">
        <table class="table">
            <thead>
                <tr>
                    <th>Incidencia ID</th>
                    <th>Recurs ID</th>
                    <th>Afectat ID</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="incidencia in paginator(incidencies)" :key="incidencia.id">
                    <td>{{ incidencia.id }}</td>
                    <td>{{ incidencia.recurs }}</td>
                    <td>{{ incidencia.afectat }}</td>
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
                perPage: 5,
                currentPage: 1,
                totalRows: '',
                incidencies: []
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
                    .get("")
                    .then((response) => {
                    console.log(response.data);
                    // me.incidencies = response.data;
                    })
                    .catch((error) => {
                    console.log(error);
                    })
                    .finally(() => (this.loading = false));

                this.totalRows = this.incidencies.length;
            }
        },
        mounted() {
            console.log('Component mounted.')
            // this.selectIncidencies();
        }
    }
</script>
