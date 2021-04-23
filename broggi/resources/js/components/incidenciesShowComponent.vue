<template>
  <div class="container">
    <div class="row">
      <h5 class="col-10">Incidencia ID #{{ incidencia.id }}</h5>

      <p class="col-2"><b>Usuaris ID:</b> {{ incidencia.usuaris_id }}</p>
    </div>

    <div>
        <div class="row">
            <p class="col-4">
                <b>Tipus Incidencia ID:</b> {{ incidencia.tipus_incidencies_id }}
            </p>
            <p class="col-4">
                <b>Tipus Incidencia:</b> {{ incidencia.tipus_incidencies.tipus }}
            </p>
        </div>


        <div class="row">
            <p class="col-4"><b>Descripcio:</b> {{ incidencia.descripcio }}</p>
        </div>

        <div class="row">
            <p class="col-4"><b>Adreca:</b> {{ incidencia.adreca }}</p>
            <p class="col-4"><b>Complement:</b> {{ incidencia.adreca_complement }}</p>
            <p class="col-4"><b>Municipi:</b> {{ incidencia.municipis_id }}</p>
        </div>

        <div class="row">
            <p class="col-4"><b>Hora:</b> {{ incidencia.hora }}</p>
            <p class="col-4"><b>Data:</b> {{ incidencia.data }}</p>
        </div>

    </div>

    <div class="row">
      <h5 class="col-10">Alertant</h5>
    </div>
    <div>
        <div class="row">
            <p class="col-4"><b>Alertant ID:</b> {{ incidencia.alertants_id }}</p>
            <p class="col-4"><b>Nom Metge:</b> {{ incidencia.nom_metge }}</p>
            <p class="col-4">
                <b>Telefon Alertant:</b> {{ incidencia.telefon_alertant }}
            </p>
        </div>
    </div>

    <div class="row">
      <h5 class="col-10">Afectats</h5>
    </div>

    <div v-for="afectat in incidencia.incidencies_has_afectats" :key="afectat.id">
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
        <p class="col-4">
          <b>Recurs Assignat: </b>
        </p>
         <p class="col-4"></p>
          <p class="col-4"></p>
      </div>

    </div>
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
    };
  },
  created() {
    this.incidencia = this.showincidencia;
  },
  mounted() {
    console.log("Component mounted.");

    console.log(this.incidencia);
  },
};
</script>
