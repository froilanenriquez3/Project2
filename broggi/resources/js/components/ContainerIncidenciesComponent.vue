<template>
    <div class="containerRecursos">
        <aside>
            <sidebar-component @changeOption="changePage($event)" :page="'incidencies'"></sidebar-component>
        </aside>

        <section class="tableSection">
        <incidencies-component :section="pageToDisplay"></incidencies-component>
        </section>
    </div>
</template>

<script>
import IncidenciesComponent from './incidenciesComponent.vue';
import SidebarComponent from './sidebarComponent'

    export default {
  components: { SidebarComponent, IncidenciesComponent },
  data() {
        return {
        // Al verse por primera vez mostrará incident.
         pageToDisplay: 'Incident'
        };
    },
        mounted() {
            console.log(`Component mounted`)
        },
        methods: {
            changePage(pageToDisplay){
                this.pageToDisplay = pageToDisplay;
            }
        }
    }
</script>
