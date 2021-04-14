<template>
  <div class="containerRecursos">
    <aside>
      <sidebar-component
        @changeOption="changePage($event)"
        :page="'incidencies'"></sidebar-component>
    </aside>
    <div id="divForm">
      <section class="tableSection">
        <incidencies-component :section="pageToDisplay"></incidencies-component>
      </section>
    </div>
  </div>
</template>

<script>
import IncidenciesComponent from "./incidenciesComponent.vue";
import SidebarComponent from "./sidebarComponent";
import videoComponent from "./videoComponent.vue";
import helpBoxComponent from "./helpBoxComponent.vue";

export default {
  components: {
    SidebarComponent,
    IncidenciesComponent,
    videoComponent,
    helpBoxComponent,
  },
  data() {
    return {
      // Al verse por primera vez mostrará incident.
      pageToDisplay: "Incident",
    };
  },
  mounted() {
    console.log(`Component mounted`);
  },
  methods: {
    changePage(pageToDisplay) {
      this.pageToDisplay = pageToDisplay;
    },
  },
};
</script>
