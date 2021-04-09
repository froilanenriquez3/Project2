<template>
  <div class="container">
    <div id="afectatsDiv">
      <div>
        <h5>Afectat</h5>

        <div class="form-group row">
          <label for="" class="col-2">Tipus d'alertant</label>
          <select name="" id="" class="col-10">
            <option value=""></option>
          </select>
        </div>

        <div class="form-group row">
          <label class="col-2" for="">Nom</label>
          <input class="col-10" type="text" name="" />
        </div>

        <div class="form-group row">
          <label class="col-2" for="">Cognom</label>
          <input class="col-10" type="text" name="" />
        </div>

        <div class="form-group row">
          <label class="col-2" for="">Telefon Alertant</label>
          <input class="col-10" type="tel" name="" />
        </div>

        <div class="form-group row">
          <label class="col-2" for="">Adreça</label>
          <input class="col-10" type="text" name="" />
        </div>

        <div class="form-group row">
          <label for="" class="col-2">Municipi</label>
          <select name="" id="" class="col-10">
            <option value=""></option>
          </select>
        </div>

        <br />
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
