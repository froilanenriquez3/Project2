<template>
  <div class="container">
      <div class="row">
          <h5 class="col-4">Incidencia ID #{{ incidencia.id }}</h5>
      </div>

      <div class="row">
        <p class="col-4">
          <b>Tipus Incidencia ID:</b> {{ incidencia.tipus_incidencies_id }}
        </p>
        <p class="col-4">
          <b>Tipus Incidencia:</b> {{ incidencia.tipus_incidencia }}
        </p>
      </div>

      <div class="row">
        <p class="col-4"><b>Descripcio:</b> {{ incidencia.descripcio }}</p>
      </div>

      <div class="row">
        <p class="col-4"><b>Adreca:</b> {{ incidencia.adreca }}</p>
        <p class="col-4">
          <b>Complement:</b> {{ incidencia.adreca_complement }}
        </p>
        <p class="col-4"><b>Municipi:</b> {{ incidencia.municipis_id }}</p>
      </div>

      <div class="row">
        <p class="col-4"><b>Hora:</b> {{ incidencia.hora }}</p>
        <p class="col-4"><b>Data:</b> {{ incidencia.data }}</p>
      </div>

      <div class="row">
        <p class="col-4"><b>Alertant ID:</b> {{ incidencia.alertants_id }}</p>
        <p class="col-4"><b>Nom Metge:</b> {{ incidencia.nom_metge }}</p>
        <p class="col-4">
          <b>Telefon Alertant:</b> {{ incidencia.telefon_alertant }}
        </p>
      </div>

      <div class="row">
        <p class="col-6"><b>Usuaris ID:</b> {{ incidencia.usuaris_id }}</p>
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
      incidencia: {

      },
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
