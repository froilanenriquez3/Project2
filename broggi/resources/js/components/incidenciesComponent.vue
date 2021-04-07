<template>
    <div class="container">
        <div class="form-group row">
    <label class="col-2" for="">Numero de incidencia</label>
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
        data(){
            return {
                incidencia: {},
                incidencies:[]
            };
        },
        methods: {
            selectIncidencies(){
                let me = this;
            axios
                .get("/incidencies")
                .then(response => {
                    console.log(response.data);
                    me.incidencies = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => (this.loading = false));
            },
            createIncidencie(){
                let me= this;
            axios
                .post('/incidencies', me.incidencia)
                .then(function (response) {
                    console.log(response);
                    me.selectIncidencies();
                    //me.action=""
                })
                .catch(error => {
                    console.log(error.response.status);
                    console.log(error.response.data);
                    me.action=''
                    // me.errorMessage= error.response.data.error;
                })
            }
        },
        created(){
            this.selectIncidencies();
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
