<template>
  <div class="containerRecursos">
    <aside>
      <sidebar-component
        @changeOption="changePage($event)"
        :page="'recursos'"
      ></sidebar-component>
    </aside>

    <section class="tableSection">
      <main-recursos-moviles-component v-show="pageToDisplay == 'Recursos'" :usertype="usertype"></main-recursos-moviles-component>
      <tipus-recursos-component v-show="pageToDisplay == 'Tipus de Recursos'" :usertype="usertype"></tipus-recursos-component>
    </section>
  </div>
</template>

<script>
import MainRecursosMovilesComponent from "./MainRecursosMovilesComponent.vue";

import SidebarComponent from "./sidebarComponent";
import TipusRecursosComponent from "./tipusRecursosComponent";
export default {
    props: {
        usertype: {
            required: false,
            type: Number
        }
    },
  components: {
    SidebarComponent,
    TipusRecursosComponent,
    MainRecursosMovilesComponent,
  },
  data() {
    return {
      pageToDisplay: "Recursos",
    };
  },
  mounted() {
    // console.log(`Component mounted`);
  },
  methods: {
    changePage(pageToDisplay) {
      this.pageToDisplay = pageToDisplay;
    },
  },
};
</script>
<style scoped>
.recursosMovilsContainer,
.tiposContainer {
  width: 70vw;
}
</style>
