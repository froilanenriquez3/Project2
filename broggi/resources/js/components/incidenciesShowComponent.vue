<template>
  <div class="container">
    <div class="row div-headers" id="showHeader">
      <h5 class="col-10">Incidencia ID #{{ incidencia.id }}</h5>

      <p class="col-2"><b>Usuaris ID:</b> {{ incidencia.usuaris.username }}</p>
    </div>

    <div>
      <div class="row">
        <p class="col-4">
          <b>Tipus Incidencia:</b> {{ incidencia.tipus_incidencies.tipus }}
        </p>
        <p class="col-4"><b>Descripcio:</b> {{ incidencia.descripcio }}</p>
      </div>

      <div class="row">
        <p class="col-4"><b>Adreca:</b> {{ incidencia.adreca }}</p>
        <p class="col-4">
          <b>Complement:</b> {{ incidencia.adreca_complement }}
        </p>
        <p class="col-4"><b>Municipi:</b> {{ incidencia.municipis.nom }}</p>
      </div>

      <div class="row">
        <p class="col-4"><b>Hora:</b> {{ incidencia.hora }}</p>
        <p class="col-4"><b>Data:</b> {{ incidencia.data }}</p>
      </div>
    </div>

    <div class="row div-headers">
      <h5 class="col-10">Alertant</h5>
    </div>
    <div>
      <div class="row">
        <p class="col-4"><b>Alertant ID:</b> {{ incidencia.alertants_id }}</p>
        <p class="col-4"><b>Nom:</b>{{ incidencia.alertants.nom }}</p>
        <p class="col-4"><b>Cognom:</b>{{ incidencia.alertants.cognoms }}</p>
      </div>
      <div class="row">
        <p class="col-4">
          <b>Telefon Alertant:</b> {{ incidencia.telefon_alertant }}
        </p>
        <p class="col-4"><b>Adreça: </b> {{ incidencia.alertants.adreca }} </p>
        <p class="col-4"><b>Nom Metge:</b> {{ incidencia.nom_metge }}</p>
      </div>
      <div class="row">
        <p class="col-4"><b>Tipus Alertant ID:</b> {{ incidencia.alertants.tipus_alertants_id }}</p>
      </div>
    </div>

    <div class="row div-headers">
      <h5 class="col-10">Afectats</h5>
    </div>

    <div v-if="incidencia.incidencies_has_afectats.length > 0">
      <div
        v-for="afectat in incidencia.incidencies_has_afectats"
        :key="afectat.id" class="card p-3">
        <div class="row">
          <p class="col-4"><b>Afectat ID:</b> {{ afectat.id }}</p>
          <p class="col-4"><b>Nom: </b> {{ afectat.nom }}</p>
          <p class="col-4"><b>Cognom: </b> {{ afectat.cognoms }}</p>
        </div>

        <div class="row">
          <p class="col-4"><b>Edat:</b> {{ afectat.edat }}</p>
          <p class="col-4"><b>Sexes :</b> {{ afectat.sexes_id }}</p>
          <p class="col-4"><b>Telefon Afectat:</b> {{ afectat.telefon }}</p>
        </div>

        <div class="row">
          <p class="col-4"><b>Recurs Assignat: </b>{{ afectat.recursos_id }}</p>
          <p class="col-4"><b>Codi: </b>{{ afectat.recursos_codi }}</p>
          <p class="col-4"><b>Prioritat: </b>{{ afectat.prioritat }}</p>
        </div>
      </div>
    </div>
    <div v-else></div>
  </div>
</template>

<script>
export default {
  props: {
    showincidencia: {
      required: true,
    },
  },
  data() {
    return {
      incidencia: {},
      recursos: [],
    };
  },
  methods: {
    initAfectatsRecursos() {
      this.incidencia.incidencies_has_afectats.forEach((element, index) => {
        let found = false;
        let i = 0;
        while (i < this.incidencia.incidencies_has_recursos.length && !found) {
          if (
            this.incidencia.incidencies_has_recursos[i].afectat_id == element.id
          ) {
            let newElement = element;

            newElement.recursos_id = this.incidencia.incidencies_has_recursos[
              i
            ].recursos_id;
            newElement.prioritat = this.incidencia.incidencies_has_recursos[
              i
            ].prioritat;

            Vue.set(
              this.incidencia.incidencies_has_afectats,
              index,
              newElement
            );

            this.findRecurso(element);

            found = true;
          }
          i++;
        }
      });
    },
    selectRecursos() {
      let me = this;
      axios
        .get("/recursos")
        .then((response) => {
          console.log(response.data);
          response.data.forEach((element) => {
            if (element.id != 1) {
              me.recursos.push(element);
            }
          });
          // me.recursos = response.data;
          me.itemsToDisplay = me.recursos;
          me.totalRows = me.itemsToDisplay.length;

          me.initAfectatsRecursos();
        })
        .catch((error) => {
          //   me.errorMessage = error.response.data.error;
          console.log(error);
          //   me.errorMessage = error.response.data.error;
        })
        .finally(() => (this.loading = false));
    },
    findRecurso(afectat) {
      let i = 0;
      let found = false;
      while (i < this.recursos.length && !found) {
        if (this.recursos[i].id == afectat.recursos_id) {
          found = true;
          afectat.recursos_codi = this.recursos[i].codi;
        } else {
          i++;
        }
      }
    },
  },
  created() {
    this.incidencia = this.showincidencia;
  },
  mounted() {
    this.selectRecursos();
  },
};
</script>
