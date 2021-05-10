<template>
    <div class="tiposContainer">
        <!-- div para el mensaje de feedback -->
        <div v-show="infoMessage !=''" class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Info: </strong>
            {{infoMessage}}
            <button type="button" @click="resetMessage()" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- fin del div para el mensaje de feedback -->
        <!-- div para el mensaje de error -->
        <div v-show="errorMessage !=''" class="alert alert-secondary alert-dismissible fade show" role="alert">
            <strong>Error: </strong>
            {{errorMessage}}
            <button type="button" @click="resetError()" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
     	</div>
        <!-- fin del div para el mensaje de error -->
    <!-- Si no se selecciona una opción, se muestra la tabla -->
    <div v-show="action == ''">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Tipus</th>
            <th v-show="usertype != 2"></th>
            <th v-show="usertype != 2"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="tipo in paginator(tipus_recursos)" :key="tipo.id">
            <th scope="row">{{ tipo.id }}</th>
            <td>{{ tipo.tipus }}</td>
            <td v-show="usertype != 2">
              <button
                type="submit"
                class="btn btn-warning btn-sm d-flex"
                @click="selectAction('editar', tipo)"
              >
                Editar
              </button>
            </td>
            <td v-show="usertype != 2">
              <button
                id="deleteB"
                type="submit"
                class="btn btn-secondary btn-sm d-flex"
                @click="confirmDeleteTipo(tipo)"
              >
                Esborrar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
                  <b-pagination
                     v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    aria-controls="my-table"
            ></b-pagination>
    </div>

    <!-- Si se selecciona la opción añadir, se muestra el formulario -->
    <div v-show="action == 'afegir' || action == 'editar'">
      <input type="hidden" v-model="tipo.id" />
      <p>{{ tipo.id }}</p>
      <div class="form-group row">
        <label class="col-2" for="tipus">Tipus</label>
        <input
          v-model="tipo.tipus"
          class="col-10"
          type="text"
          id="tipus"
          name="tipus"
        />
      </div>

      <button
        v-if="action == 'afegir'"
        type="button"
        @click="afegirTipo()"
        class="btn btn-primary"
      >
        Afegir
      </button>
      <button
        v-else
        type="button"
        @click="editarTipo()"
        class="btn btn-warning"
      >
        Editar
      </button>


      <button  type="button" @click="cancel()" class="btn btn-primary" id="cancelButton">Cancel·lar</button>
    </div>

    <button
      class="btn btn-primary"
      id="addButton"
      @click="selectAction('afegir')"
    >
      Afegir
    </button>

    <!-- Modal Delete -->
            <div class="modal fade" id="deleteModalTipus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Esborrar tipus de Recurs</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modalText" class="modal-body">
            Està segur d'esborrar el tipus de Recurs {{ tipo.tipus }}?
        </div>
        <div class="modal-footer">
            <button id="buttonDeleteModal"  @click="deleteTipo()" type="submit" class="btn btn-secondary">Esborrar</button>
        </div>
      </div>
    </div>
  </div>

  </div>
</template>

<script>
export default {
    props: {
        usertype: {
            required: false,
            type: Number
        }
    },
  data() {
    return {
        infoMessage:'',
        errorMessage:'',
        action: "",
        perPage: 5,
        currentPage: 1,
        totalRows: '',
        tipus_recursos: [],
        insert: false,
        tipo: {
            id: "",
            tipus: "",
        },
    };
  },
  methods: {
      cancel(){
          this.action = '';
          document.getElementById("addButton").style.display = "block";
          this.tipo =  {
                id: "",
                tipus: "",
            };
      },
    selectTipus() {
      let me = this;
      axios
        .get("/tipusrecursos")
        .then((response) => {
            me.tipus_recursos = response.data;
            me.totalRows= me.tipus_recursos.length;
        })
        .catch((error) => {
            me.errorMessage= error.response.data.error;
            console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    afegirTipo() {
      let me = this;
       console.log("adding");
      axios
        .post("/tipusrecursos", me.tipo)
        .then(function (response) {
            console.log(response);
            me.selectTipus();
            me.tipo =  {
                    id: "",
                    tipus: "",
                };
            me.action='';
            document.getElementById("addButton").style.display = "block";
            me.infoMessage = 'Tipus afegit correctament.';
             this.selectTipus();

        })
        .catch((error) => {
          console.log(error.response.status);
          console.log(error.response.data);
          me.action='';
          me.errorMessage= error.response.data.error;
        })
        .finally(() =>{
            this.selectTipus();
        });
    },
    editarTipo() {
         console.log("updating");
      let me = this;
      axios
        .put("/tipusrecursos/" + me.tipo.id, me.tipo)
        .then(function (response) {
            console.log(response);
            me.selectTipus();
            me.action='';
                me.tipo =  {
                    id: "",
                    tipus: "",
                };
             me.infoMessage = 'Tipus modificat correctament.';
              this.selectTipus();
        })
        .catch((error) => {
          console.log(error.response.status);
          console.log(error.response.data);
          me.action='';
          me.errorMessage= error.response.data.error;
        })
        .finally(() =>{
            this.selectTipus();
        });
    },
    confirmDeleteTipo(tipo) {
      this.tipo = tipo;
      $('#deleteModalTipus').modal('show');
    },
    deleteTipo() {
        console.log("deleting");
      let me = this;
      axios
        .delete("/tipusrecursos/" + me.tipo.id)
        .then((response) => {
          me.selectTipus();
          $("#deleteModalTipus").modal("hide");
            me.action='';
          //me.infoMessage= response.data.missatge;
           me.infoMessage = 'Tipus eliminat correctament.';
        this.selectTipus();
        })
        .catch((error) => {
          me.errorMessage = error.response.data.error;
          $("#deleteModalTipus").modal("hide");
            me.action='';
        })
        .finally(() =>{
            this.selectTipus();
        });
    },
    selectAction(action, tipo) {
      this.action = action;
      if(action != "borrar"){
         document.getElementById("addButton").style.display = "none";
      }

      if (action == "editar" || action == "borrar") {
        this.tipo = tipo;
      }
    },
     paginator(recursos) {
        //  Devuelve parte del array que va a usar esa página concreta.
      const beginning = (this.currentPage - 1) * this.perPage;
      const end =
       beginning + this.perPage > recursos.length
          ? recursos.length
          : beginning  + this.perPage;
      return recursos.slice(beginning , end );
    },
    resetError(){
        this.errorMessage='';
    },
    resetMessage(){
        this.infoMessage = '';
    }
  },
  created() {
    this.selectTipus();
  },
  mounted() {
    // console.log("Component mounted.");
  },
};
</script>
