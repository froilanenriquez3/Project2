<template>
  <div class="container">
    <div id="alertantsDiv">
      <div>
        <h5>Afectat 1</h5>

        <label for="">Tipus d'alertant</label>
        <select name="" id="">
          <option value=""></option>
        </select>

        <label class="" for="">Nom</label>
        <input class="" type="text" name="" />

        <label class="" for="">Cognom</label>
        <input class="" type="text" name="" />

        <label class="" for="">Telefon Alertant</label>
        <input class="" type="tel" name="" />

        <br />

        <label class="" for="">Adreça</label>
        <input class="" type="text" name="" />

        <label for="">Municipi</label>
        <select name="" id="">
          <option value=""></option>
        </select>
      </div>


        <button class="btn btn-primary">Submit</button>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    getMunicipis() {},
    getTipusAlertant() {},
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
