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
                this.incidencies = [
                    {
                        id: 1,
                        recurs: 1,
                        afectat: 1
                    },
                    {
                        id: 2,
                        recurs: 2,
                        afectat: 2
                    },
                    {
                        id: 3,
                        recurs: 1,
                        afectat: 1
                    },
                    {
                        id: 4,
                        recurs: 2,
                        afectat: 2
                    },{
                        id: 5,
                        recurs: 1,
                        afectat: 1
                    },
                    {
                        id: 6,
                        recurs: 2,
                        afectat: 2
                    },{
                        id: 7,
                        recurs: 1,
                        afectat: 1
                    },
                    {
                        id: 8,
                        recurs: 2,
                        afectat: 2
                    },{
                        id: 9,
                        recurs: 1,
                        afectat: 1
                    },
                    {
                        id: 10,
                        recurs: 2,
                        afectat: 2
                    },
                    {
                        id: 8,
                        recurs: 2,
                        afectat: 2
                    },{
                        id: 9,
                        recurs: 1,
                        afectat: 1
                    },
                    {
                        id: 10,
                        recurs: 2,
                        afectat: 2
                    }
                ];

                this.totalRows = this.incidencies.length;
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.selectIncidencies();
        }
    }
</script>
