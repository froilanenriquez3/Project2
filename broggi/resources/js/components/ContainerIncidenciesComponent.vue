<template>
    <div class="containerRecursos">
        <aside>
            <sidebar-component @changeOption="changePage($event)" :page="'incidencies'"></sidebar-component>
        </aside>

        <section class="tableSection">
        <incidencies-component :section="pageToDisplay"></incidencies-component>

        <div id="modoFormacion">
                <video-component></video-component>
                <help-box></help-box>
        </div>
        </section>


    </div>
</template>

<script>
import IncidenciesComponent from './incidenciesComponent.vue';
import SidebarComponent from './sidebarComponent';
import videoComponent from './videoComponent.vue';
import helpBoxComponent from './helpBoxComponent.vue';

    export default {
  components: { SidebarComponent, IncidenciesComponent, videoComponent, helpBoxComponent },
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
