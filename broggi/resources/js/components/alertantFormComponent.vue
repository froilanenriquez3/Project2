<template>
  <div class="container">
    <div id="alertantsDiv">
      <div>
        <h5>Alertant</h5>

        <div class="form-group row">
          <label class="col-2" for="">Tipus d'alertant</label>
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
          <label class="col-2" for="">Municipi</label>
          <select class="col-10" name="" id="">
            <option value=""></option>
          </select>
        </div>

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
