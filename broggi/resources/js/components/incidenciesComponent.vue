<template>
<div class="biggerContainer">
    <!-- div para el mensaje de error -->
        <div v-show="errorMessage !=''" class="alert alert-secondary alert-dismissible fade show" role="alert">
            <strong>Error: </strong>
            {{errorMessage}}
            <button type="button" @click="resetError()" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
     	</div>
    <!-- fin del div para el mensaje de error -->
    <div id="divModoFormacion" v-bind:class="{ formacionActive: formacio }">
        <button class="btn btn-primary" @click="openModalVideo()" v-bind:class="{ hidden: !formacio }">Veure video CPR</button>
    <button class="btn btn-primary" @click="openModalHelp()" v-bind:class="{ hidden: !formacio }">Ajuda amb l'anglès</button>
    <div class="formacionBox">
    <p>Mode formació</p>
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
        <label class="col-2" for=""><b>Tipus Incidència</b></label>
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
      <label class="col-2" for=""><b>Descripció</b></label>
      <textarea class="col-10" type="" name="" v-model="incidencia.descripcio" maxlength="256">
      </textarea>
    </div>

    <div class="form-group row">
      <label class="col-2" for="">Nom Metge</label>
      <input class="col-10" type="tel" name="" v-model="incidencia.nom_metge" />
    </div>
    </div>

    <!-- TAG ALERTANTE -->
    <alertant-form @dadesAfectat="canviarDades($event)" :municipis="municipis" :alertant="alertantIncidencia" :section="section" v-show="section == 'Alertant'"></alertant-form>

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
        <!-- El mapa se enseña en caso de que hayan escrito algo en afectados, tanto si éstos son múltiples
        como si no. -->
        <div v-show="(!multiple && numAfectats > 0) || multiple">
        <map-component :recursPerCanviar="recursPerCanviar" @desassignantRecurs="removeRecursFromMap($event)" @assignantRecurs="setRecursFromMap($event)" :direccioCompleta="direccio"></map-component>
        </div>
        <!-- No se muestra si no hay afectados aún puestos y no es múltiple -->
        <div id="insideRecursos" v-show="!multiple && numAfectats > 0">

        <div id="recursosAfectats"><table class="table">
  <thead>
    <tr class="row">
        <th class="col-4">Afectat</th>
        <th class="col-4">Recurs</th>
        <th class="col-2">Prioritat</th>
        <th class="col-2"></th>
    </tr>
  </thead>
  <tbody>
    <tr class="afectat row" @click="setAfectatActual(afectat)" v-bind:class="{ afectatActiu: afectat.id == afectatActiu}" v-for="(afectat, index) in afectats" :key="index">
      <td class="col-4" :id="'btnAfectat' + afectat.id">
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
            <div v-if="infoRecursos[afectat.id]" :id="'recursAssignat'+afectat.id">{{infoRecursos[afectat.id].tipus}}</div>

      </td>
            <td class="col-2">
                <select v-if="infoRecursos[afectat.id] && 'tipus' in infoRecursos[afectat.id]" v-model="infoRecursos[afectat.id].prioritat" class="form-select" aria-label="Default select example">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
        </td>
      <td class="col-2">
          <button class="btn btn-primary" :class="'noRecurs'+afectat.id" @click="noRecurs(afectat)">No cal recurs</button>
      </td>

    </tr>
  </tbody>
</table>

        </div>
</div>

<!-- Se muestra si no es múltiple pero el teleoperador aún no ha escrito en afectados -->

    <div v-show="!multiple && numAfectats == 0">
        <p>Encara no s'han registrat afectats. Es necessita un mínim d'un afectat perquè l'incidència sigui vàlida.</p>
    </div>

<!-- Se muestra si hay múltiples afectados -->
    <div v-show="multiple">
        Assigna tants recursos com creguis necessaris utilitzant el mapa i seràn enviats a l'accident.
         <div id="recursosAfectatsMultiples"><table class="table">
  <thead>
    <tr class="row">
        <th class="col-2">Prioritat</th>
        <th class="col-4">Recurs</th>
    </tr>
  </thead>
  <tbody>
      <!-- Como en este caso no hay afectados, se cogerá el index para diferenciar los recursos que enviaremos -->
    <tr class="row" v-for="(recurs, index) in recursosToShow" :key="index">
        <td class="col-2"><select v-model="recurs.prioritat" class="form-select" aria-label="Default select example">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
        </td>
      <td class="col-4">
          {{recurs.tipus}}
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
      Afegir incidència
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
        },
        editincidencia:{
            required: false
        }
    },
  data() {
    return {
        errorMessage:'',
        formacio: false,
        recursPerCanviar: '',
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
        recursos_id: 1,
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
            id: 1,
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
        telefon_alertant: null,
        adreca: null,
        adreca_complement: null,
        descripcio: null,
        nom_metge: null,
        tipus_incidencies_id: null,
        alertants_id: null,
        municipis_id: null,
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
          me.errorMessage= error.response.data.error;
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    noRecurs(afectat){
        let infoRecurs = {
            recursos_id: 1,
            hora_activacio: null,
            hora_mobilitzacio: null,
            hora_assistencia: null,
            hora_transport: null,
            hora_arribada_hospital: null,
            hora_transferencia: null,
            hora_finalitzacio: null,
            prioritat: '',
            desti: null,
            afectat_id: this.afectatActiu
        };
        // Antes de modificar enviamos el recurso al mapa, ya que se va a tener que desactivar desde allí
        if(this.infoRecursos[afectat.id]){
        if(this.infoRecursos[afectat.id].hasOwnProperty('tipus')){
            this.recursPerCanviar= this.infoRecursos[afectat.id];
        }
        }
         Vue.set(this.infoRecursos, afectat.id, infoRecurs)

    },
    removeRecursFromMap(recurs){
        // Cuando desasignamos un recurso de un afectado.
        // Buscamos índice del infoRecurs que tiene el recurso con ese código asignado.
       let foundRecurs= this.infoRecursos.findIndex( recurso => recurso.tipus == recurs.codi);
       let infoRecurs = {
            recursos_id: 1,
            hora_activacio: null,
            hora_mobilitzacio: null,
            hora_assistencia: null,
            hora_transport: null,
            hora_arribada_hospital: null,
            hora_transferencia: null,
            hora_finalitzacio: null,
            prioritat: '',
            desti: null,
            afectat_id: this.afectatActiu
        };

    if(this.multiple){
        this.infoRecursos.splice(foundRecurs,1);
    }else {
        Vue.set(this.infoRecursos, foundRecurs, infoRecurs)
    }

    },
    setRecursFromMap(recurs){
        debugger;
        if(this.infoRecursos[this.afectatActiu]){
        if(this.infoRecursos[this.afectatActiu].hasOwnProperty('tipus') && !this.multiple){
            this.recursPerCanviar= this.infoRecursos[this.afectatActiu];
        }
        }
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
            prioritat: null,
            desti: null,
            afectat_id: this.afectatActiu,
            tipus: recurs.codi
        };
        // OPCIÓN 1: Múltiple
        if(this.multiple){
            // cambiamos el id por uno fantasma.
            this.infoRecurs.afectat_id= 300;
            this.infoRecursos.push(this.infoRecurs);
            this.incidencia.infoRecursos = this.infoRecursos;
        } else {
        // OPCIÓN 2: Afectado con recurso asignado.
            // Los ponemos en el mismo orden que los afectados para ahorrarnos problemas.
        Vue.set(this.infoRecursos, this.afectatActiu, this.infoRecurs);
        this.incidencia.infoRecursos = this.infoRecursos;
        console.log(this.incidencia);
        }

    // Otros casos controlados desde removeRecursFromMap y noRecurs. Prioridad controlada desde setPrioritat.

    },
    setAfectatActual(afectat){
        this.afectatActiu= afectat.id;
    },
    canviarDades(trobat){
        this.alertantIncidencia.telefon = trobat.telefon;
        this.alertantIncidencia.nom = trobat.nom;
        this.alertantIncidencia.cognoms = trobat.cognoms;
        this.alertantIncidencia.municipis_id= trobat.municipis_id;
        this.alertantIncidencia.tipus_alertants_id= trobat.tipus_alertants_id;
        this.alertantIncidencia.adreca = trobat.adreca;
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

        // Si ya hay recursos (porque se ha apretado múltples y luego se ha decidido cambiar).
        if(this.infoRecursos[this.afectat.id] && this.infoRecursos[this.afectat.id].afectat_id == 300){
            this.infoRecursos[this.afectat.id].afectat_id = this.numAfectats;
        }

        // Teniendo el id falso, vamos a crear un infoRecursos para ese afectado.
        this.infoRecursos[this.numAfectats] = {
                    recursos_id: null,
                    hora_activacio: null,
                    hora_mobilitzacio: null,
                    hora_assistencia: null,
                    hora_transport: null,
                    hora_arribada_hospital: null,
                    hora_transferencia: null,
                    hora_finalitzacio: null,
                    prioritat: null,
                    desti: null,
                    afectat_id: this.numAfectats,
                    }

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
          me.errorMessage= error.response.data.error;
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
          me.errorMessage= error.response.data.error;
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
          me.errorMessage= error.response.data.error;
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
                    me.errorMessage= error.response.data.error;
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
        let me = this;
        if(this.editincidencia != null){
            this.incidencia.afectats= this.afectats;
            this.incidencia.incidencies_has_recursos = this.infoRecursos;
             axios
                .put("/incidencies/"+me.incidencia.id, me.incidencia)
                .then((response)=>{
                    alert("Formulari enviat correctament");
                    window.location.href = "/Project2/broggi/public/incidencies";
                    console.log(response);
                    me.incidencia = null;
                })
                .catch((error)=>{
                    console.log(error);
                    console.log(error.response.status);
                    console.log(error.response.data);
                })
        } else {
            // Si no se ha asignado ningún recurso a una persona y tampoco se ha apretado 'no cal recurs',
            // le ponemos el fantasma igual por defecto
            this.afectats.forEach(element => {
                if(!this.infoRecursos[element.id]){
                    this.infoRecursos[element.id] = {
                    recursos_id: 1,
                    hora_activacio: null,
                    hora_mobilitzacio: null,
                    hora_assistencia: null,
                    hora_transport: null,
                    hora_arribada_hospital: null,
                    hora_transferencia: null,
                    hora_finalitzacio: null,
                    prioritat: null,
                    desti: null,
                    afectat_id: element.id,
                    }
                }
            });
            // Comprobaciones por si se ha ido cambiando el toggle entre múltiples y no.
            if(!this.multiple){
                this.incidencia.afectats= this.afectats;

                // Eliminamos infoRecursos que tengan todo fantasma.
                // Puede ocurrir si se han llenado muchos recursos en múltiples y luego se cambia a afectados.
                this.infoRecursos= this.infoRecursos.filter( element => element.afectat_id != 300);
            } else {
                this.infoRecursos.forEach(element => {
                // Nos aseguramos de que todos los afectados sean fantasma.
                    element.afectat_id= 300
                });

                 this.incidencia.descripcio= this.multiplesAfectats;
            }

            this.incidencia.infoRecursos= this.infoRecursos;
            console.log("submitting incidencia");
            console.log(this.incidencia);
            // let me = this;
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
              me.errorMessage= error.response.data.error;
            });
        }

    },
    toggleMultiple(){
        if(this.multiple) this.multiple = false;
        else this.multiple = true;

    },
    setPrioritat(afectat){
        if(this.multiple){
            this.infoRecursos[afectat].prioritat = Number(this.prioritat);
        } else {
            this.infoRecursos[afectat.id].prioritat = Number(this.prioritat);
        }
  },
    resetError(){
        this.errorMessage='';

    },
    initEditIncidencia(){
        if(this.editincidencia != null ){
            this.incidencia = this.editincidencia;
            this.afectats = this.incidencia.incidencies_has_afectats;
            this.initAlertant();
            this.initAfectats();
        }
    },
    initAlertant(){
        let me = this;
        axios
            .get("/alertants/"+ me.incidencia.alertants_id)
            .then(response => {
                me.alertantIncidencia = response.data;
            })
            .catch(error => {
                console.log(error);
            })
            .finally(() => (this.loading = false));
    },
    initAfectats(){

        for (let i in this.afectats) {
            //Creamos afectatFormComponent y le pasamos el afectat de la posición numAfectats y la posición que ocupará en la array;
            let ComponentClass= Vue.extend(afectatFormComponent)
            let form= new ComponentClass({
                propsData: { position: i, afectat: this.afectats[i] }
            });

            form.$mount()
            this.$refs.afectatsContainer.appendChild(form.$el);
            this.numAfectats ++;
        }



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
    this.initEditIncidencia();

  },
  computed:{
      direccio: function(){
          return `${this.incidencia.adreca}, ${this.municipi.nom}`;
      },
      multiplesAfectats: function(){
          let descripcioAfectats;
          if(this.multiplesAfectatsText == ''){
              descripcioAfectats = this.incidencia.descripcio;
          }else{
              descripcioAfectats = this.incidencia.descripcio + " (Múltiples Afectats: " +this.multiplesAfectatsText+ ")";
          }

          return descripcioAfectats;
      },
      recursosToShow: function(){
          return this.infoRecursos;
      }
  }
};
</script>

