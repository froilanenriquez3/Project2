<template>
    <div class="container">
        <div class="form-group row">
    <label class="col-2" for="">Numero de incidente</label>
    <input class="col-10" type="number"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Data</label>
    <input class="col-10" type="date"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Hora</label>
    <input class="col-10" type="number"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Telefon Alertant</label>
    <input class="col-10" type="tel"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Adreca</label>
    <input class="col-10" type="tel"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Adreca Complement</label>
    <input class="col-10" type="tel"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Descripcio</label>
    <input class="col-10" type="tel"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Nom Metge</label>
    <input class="col-10" type="tel"  name="">
</div>
<div class="form-group row">
    <label class="col-2" for="">Tipus Incidencia</label>
    <select class="col-10" name=""  ></select>
</div>
<div class="form-group row">
    <label class="col-2" for="">Alertant</label>
    <input class="col-10" type="text"  name="">
</div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
