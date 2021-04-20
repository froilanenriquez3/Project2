<template>
<div class="biggerContainer">

    <div id="divModoFormacion" v-bind:class="{ formacionActive: formacio }">
        <button class="btn btn-primary" @click="openModalVideo()" v-bind:class="{ hidden: !formacio }">Veure video CPR</button>
    <button class="btn btn-primary" @click="openModalHelp()" v-bind:class="{ hidden: !formacio }">Ajuda amb l'anglès</button>
    <div class="formacionBox">
    <p>Modo formació</p>
            <label class="switch" id="btnModoFormacion">
                <input @click="toggleFormacio()" type="checkbox">
                <span class="slider round"></span>
            </label>
            </div>
        </div>
    <div class="container" >

        <!-- TAG INCIDENCIAS -->
        <div v-show="section == 'Incident'">
        <div class="form-group row">
        <label class="col-2" for=""><b>Tipus Incidencia</b></label>
        <select class="col-10" name="tipus_incidencia" v-model="incidencia.tipus_incidencies_id">
            <option v-for="tipo in tipusIncidencies" :key="tipo.id" v-bind:value="tipo.id">
            {{ tipo.tipus }}
            </option>
        </select>
    </div>

    <div class="form-group row">
      <label class="col-2" for=""><b>Adreça</b></label>
      <input class="col-10" type="tel" name="" v-model="incidencia.adreca" />
    </div>
    <div class="form-group row">
      <label class="col-2" for="">Adreça Complement</label>
      <input
        class="col-10"
        type="tel"
        name=""
        v-model="incidencia.adreca_complement"
      />
    </div>
    <div class="form-group row">
      <label class="col-2" for=""><b>Municipi</b></label>
      <select class="col-10" name="" id="" v-model="incidencia.municipis_id">
        <option value=""></option>
        <option v-for="(municipi, index) in municipis" :key="index" v-bind:value="municipi.id">
          {{ municipi.nom }}
        </option>
      </select>
    </div>
<!--  -->
    <div class="form-group row">
      <label class="col-2" for=""><b>Hora</b></label>
      <input class="col-3" type="time" name="" v-model="incidencia.hora" />

      <label class="col-2" for=""><b>Data</b></label>
      <input class="col-3" type="date" name="" v-model="incidencia.data" />
    </div>

    <div class="form-group row">
      <label class="col-2" for=""><b>Descripcio</b></label>
      <textarea class="col-10" type="" name="" v-model="incidencia.descripcio">
      </textarea>
    </div>

    <div class="form-group row">
      <label class="col-2" for="">Nom Metge</label>
      <input class="col-10" type="tel" name="" v-model="incidencia.nom_metge" />
    </div>
    </div>

    <!-- TAG ALERTANTE -->
    <alertant-form :municipis="municipis" :alertant="alertantIncidencia" :section="section" v-show="section == 'Alertant'"></alertant-form>

    <!-- TAG AFECTADO -->
    <!-- add fa plus icon -->
    <div v-show="section == 'Afectats' ">

       <!--  <button @click="notMultiple()" class="btn btn-secondary">Menys de 3 afectats</button>
        <button @click="isMultiple()" class="btn btn-secondary">Múltiples afectats (+3)</button> -->
       <span>Menys de 3 afectats</span>
        <label class="switch" id="btnNumAfectats">
                <input type="checkbox" @click="toggleMultiple()">
                <span class="slider round"></span>
            </label>
        <span>Múltiples afectats (+3)</span>

        <div v-show="multiple == false">
             <button @click="nouAfectat()" class="btn btn-primary">Nou Afectat</button>
             <div  ref="afectatsContainer"></div>
        </div>


        <div v-show="multiple == true" >
            <div class="form-group row">
            <label for="multiplesAfectats">Descripció afectats</label>
            <textarea v-model="multiplesAfectatsText"
            placeholder="Indica el sexe dels alertants i el rang d'edats aproximat"
            class="form-control" id="multiplesAfectats" rows="3"></textarea>
            </div>

        </div>

    </div>



    <!-- TAG RECURSOS -->
    <div v-show="section == 'Recursos'" id="recursosPage">
        <div id="insideRecursos" v-show="!multiple">
        <map-component @assignantRecurs="setRecursFromMap($event)" :direccioCompleta="direccio"></map-component>

        <div id="recursosAfectats"><table class="table">
  <thead>
    <tr class="row">
        <th class="col-2">Prioritat</th>
        <th class="col-4">Afectat</th>
        <th class="col-4">Recurs</th>
        <th class="col-2"></th>
    </tr>
  </thead>
  <tbody>
    <tr class="row" v-for="(afectat, index) in afectats" :key="index">
        <td class="col-2">
            <input type="number" min="1" max="4" :id="'prioritat' + afectat.id" name="prioritat" value="1" v-model="prioritat" @change="setPrioritat(afectat)">
        </td>
      <td class="afectat col-4" :id="'btnAfectat' + afectat.id"  @click="setAfectatActual(afectat)" v-bind:class="{ afectatActiu: afectat.id == afectatActiu}">
          <div >
              <p v-if="afectat.sexes_id == 1">Home
                            <span v-show="afectat.edat != ''">{{', '+ afectat.edat  + " anys "}}</span>
                              <span v-show="afectat.nom != ''">{{ '('+afectat.nom+')' }}</span>

                        <p v-else-if="afectat.sexes_id == 2">Dona
                           <span v-show="afectat.edat != ''">{{', '+ afectat.edat  + " anys "}}</span>
                              <span v-show="afectat.nom != ''">{{'(' +afectat.nom+ ')' }}</span>
                        </p>
          </div>
      </td>
      <td class="col-4">
           <div v-show="afectat.id == afectatActiu && (infoRecursos[afectat.id] == undefined)">
                        assigna un recurs del mapa
                    </div>
            <div  v-show="(infoRecursos[afectat.id] != undefined)" :id="'afectat' + afectat.id" ></div>
      </td>
      <td class="col-2">
          <button class="btn btn-primary" @click="setRecursFromMap(recurs)">Cap</button>
      </td>

    </tr>
  </tbody>
</table>

        </div>
</div>
    </div>



    <!-- Modal Video -->
    <div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="modalVideolLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalVideolLabel">Vídeo CPR</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modalText" class="modal-body">
            <video-component></video-component>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalHelpbox" tabindex="-1" role="dialog" aria-labelledby="modalVideolLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalVideolLabel">HelpBox</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modalText" class="modal-body">
            <help-box-component></help-box-component>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>


    <button class="btn btn-primary mt-2" @click="afegirIncidencia()" id="btnAddIncidencia">
      Afegir incidencia
    </button>




  </div>
</div>
</template>

<script>
import alertantFormComponent from "./alertantFormComponent.vue";
import afectatFormComponent from "./afectatFormComponent.vue";
import mapComponent from './mapComponent.vue';
import HelpBoxComponent from './helpBoxComponent.vue';
import Vue from 'vue';
export default {
  components: { mapComponent, HelpBoxComponent },
    props: {
        //Sección que se tiene que mostrar
        section: {
            type: String,
            required: true
        }
    },
  data() {
    return {
    formacio: false,
      tipusAlertants: [],
      tipusIncidencies: [],
      alertantIncidencia: {},
      numAfectats: 0,
      afectat: {
          id: '1',
          telefon: '',
          cip: '',
          nom:'',
          cognoms: '',
          edat:'',
          te_cip:'',
          sexes_id:'1'
      },
      afectats: [],
      recursos: [],
      prioritat: null,
      freeRecursos: [],
      infoRecursos: [],
      infoRecurs: {
        recursos_id: 12,
        hora_activacio: null,
        hora_mobilitzacio: null,
        hora_assistencia: null,
        hora_transport: null,
        hora_arribada_hospital: null,
        hora_transferencia: null,
        hora_finalitzacio: null,
        prioritat: null,
        desti: null,
        afectat_id: null
      },
      recurs: {
            id: 12,
            codi: "cap",
            actiu: true,
            tipus_recursos_id: 1,
            lat: 50,
            lon: 1
        },
      municipi: {},
      municipis: [],
      multiple: false,
      multiplesAfectatsText: '',
        afectatActiu: 0,
      afectatFormComponent,
      alertantFormComponent,
      incidencia: {
        data: null,
        hora: null,
        telefon_alertant: 123456789,
        adreca: null,
        adreca_complement: null,
        descripcio: null,
        nom_metge: null,
        tipus_incidencies_id: 1,
        alertants_id: 1,
        municipis_id: 1,
        duracion: null,
        infoRecursos: [],
        afectats: []
      },
      incidencies: [],
    };
  },
  methods: {
    getIncidencies() {
      let me = this;
      axios
        .get("/incidencies")
        .then((response) => {
          console.log(response.data);
          me.incidencies = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    setRecursFromMap(recurs){
        // Aquí el id del afectado aún es el que tiene en la array! Lo substituiremos al añadir la incidencia.
        this.infoRecurs = {
            recursos_id: recurs.id,
            hora_activacio: null,
            hora_mobilitzacio: null,
            hora_assistencia: null,
            hora_transport: null,
            hora_arribada_hospital: null,
            hora_transferencia: null,
            hora_finalitzacio: null,
            prioritat: Number(this.prioritat),
            desti: null,
            afectat_id: this.afectatActiu
        };
        // Los ponemos en el mismo orden que los afectados para ahorrarnos problemas.
        this.infoRecursos[this.afectatActiu]= this.infoRecurs;
        this.incidencia.infoRecursos = this.infoRecursos;
        console.log(this.incidencia);
        // Hacemos que se muestre el recurso seleccionado en el tipo de recurso.
        document.getElementById('afectat' + this.afectatActiu).innerHTML= recurs.codi;
        console.log("btnAfectat"+this.afectatActiu);
        document.getElementById("btnAfectat"+this.afectatActiu).setAttribute("disabled", true);
    },
    setAfectatActual(afectat){
        this.afectatActiu= afectat.id;

    },
    isMultiple(){
        this.multiple= true;
    },
    nouAfectat(){
        this.multiple= false;
      this.afectat= {
          id: '',
          telefon: '',
          cip: '',
          nom:'',
          cognoms: '',
          edat:'',
          te_cip:'',
          sexes_id:'1'
      }

      this.afectats.push(this.afectat);

    //Creamos afectatFormComponent y le pasamos el afectat de la posición numAfectats y la posición que ocupará en la array;
        let ComponentClass= Vue.extend(afectatFormComponent)
        let form= new ComponentClass({
            propsData: { position: this.numAfectats, afectat: this.afectats[this.numAfectats] }
        });

        form.$mount()
        this.$refs.afectatsContainer.appendChild(form.$el)
       this.numAfectats++;
    },
    openModalVideo(){
        $('#modalVideo').modal('show');
    },
        openModalHelp(){
        $('#modalHelpbox').modal('show');
    },
    getMunicipis() {
      let me = this;
      axios
        .get("/municipis")
        .then((response) => {
          me.municipis = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    getTipusIncidencies(){
        let me = this;
      axios
        .get("/tipusincidencies")
        .then((response) => {
          console.log(response.data);
          me.tipusIncidencies = response.data;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    getAfectats(){
        let me = this;
      axios
        .get("/afectats")
        .then((response) => {
          console.log(response.data);

        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    getRecurs(){
        let me = this;
            axios
                .get("/recursos")
                .then(response => {
                    me.recursos = response.data;
                    me.getFreeRecurs();
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => (this.loading = false));
    },
    getFreeRecurs(){
        for(let i in this.recursos){
            if(!this.recursos[i].actiu){
                this.freeRecursos.push(this.recursos[i]);
            }
        }
    },
    notMultiple(){
        this.multiple= false;
    },
    assignRecurs(index, afectatId){
        // Aquí el id del afectado aún es el que tiene en la array! Lo substituiremos al añadir la incidencia.
        let recursId = Number(document.getElementById("recursosToAssign" + index).value);
        this.infoRecurs = {
            recursos_id: recursId,
            hora_activacio: null,
            hora_mobilitzacio: null,
            hora_assistencia: null,
            hora_transport: null,
            hora_arribada_hospital: null,
            hora_transferencia: null,
            hora_finalitzacio: null,
            prioritat: null,
            desti: null,
            afectat_id: afectatId
        };
        // Los ponemos en el mismo orden que los afectados para ahorrarnos problemas.
        this.infoRecursos[afectatId]= this.infoRecurs;
        this.incidencia.infoRecursos = this.infoRecursos;

    },
    clearInput() {
      this.incidencia = {
        data: null,
        hora: null,
        telefon_alertant: null,
        adreca: null,
        adreca_complement: null,
        descripcio: null,
        nom_metge: null,
        tipus_incidencies_id: null,
        alertants_id: null,
        municipis_id: null,
        duracion: null,
      };
    },
    updateAlertant(alertant){
        this.alertantIncidencia= alertant;
    },
    toggleFormacio(){
        this.formacio = !this.formacio;
    },
    afegirIncidencia(){
        this.incidencia.afectats= this.afectats;

        console.log("submitting incidencia");
        console.log(this.incidencia);
        let me = this;
        axios
        .post("/incidencies", me.incidencia)
        .then(function (response) {
          alert("Incidencia inserted correctly!");
          console.log(response);
          me.clearInput();
          me.getIncidencies();
          //me.action=""
        })
        .catch((error) => {
          console.log(error.response.status);
          console.log(error.response.data);
          me.action = "";
          // me.errorMessage= error.response.data.error;
        });


  },
  toggleMultiple(){
      if(this.multiple) this.multiple = false;
      else this.multiple = true;
  },
  setPrioritat(afectat){
      this.infoRecursos[afectat.id].prioritat = Number(this.prioritat);
  }
  },
  created() {
    //this.selectIncidencies();
    this.getMunicipis();
    this.getTipusIncidencies();
    // this.getAfectats();
    this.getRecurs();
  },
  mounted() {
    // console.log("Component mounted.");
    // this.nouAfectat();

  },
  computed:{
      direccio: function(){
          return `${this.incidencia.adreca}, ${this.municipi.nom}`;
      }
  }
};
</script>
