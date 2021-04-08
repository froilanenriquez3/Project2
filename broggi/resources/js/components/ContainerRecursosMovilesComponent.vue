<template>
    <div class="containerRecursos">
        <aside>
            <sidebar-component @changeOption="changePage($event)" :page="'recursos'"></sidebar-component>
        </aside>

        <section class="tableSection">
        <main-recursos-moviles-component v-show="pageToDisplay == 'Recursos'"></main-recursos-moviles-component>
        <tipus-recursos-component v-show="pageToDisplay == 'Tipus de Recursos'"></tipus-recursos-component>
        </section>
    </div>
</template>

<script>
import MainRecursosMovilesComponent from './MainRecursosMovilesComponent.vue';

import SidebarComponent from './sidebarComponent'
import TipusRecursosComponent from './tipusRecursosComponent';
    export default {
  components: { SidebarComponent, TipusRecursosComponent, MainRecursosMovilesComponent },
  data() {
        return {
            pageToDisplay: 'Recursos'
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
