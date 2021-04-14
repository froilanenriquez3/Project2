<template>
  <div class="tiposContainer">
    <!-- Si no se selecciona una opción, se muestra la tabla -->
    <div v-show="action == ''">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Tipus</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="tipo in paginator(tipus_alertants)" :key="tipo.id">
            <th scope="row">{{ tipo.id }}</th>
            <td>{{ tipo.tipus }}</td>
            <td>
              <button
                type="submit"
                class="btn btn-warning btn-sm d-flex"
                @click="selectAction('editar', tipo)"
              >
                Editar
              </button>
            </td>
            <td>
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


      <button  type="button" @click="cancel()" class="btn btn-primary" id="cancelButton">Cancelar</button>
    </div>

    <!-- Modal Delete -->
    <div
      class="modal fade"
      id="deleteModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Esborrar tipus</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div id="modalText" class="modal-body">
            Està segur d'esborrar el tipus {{ tipo.tipus }} ?
          </div>
          <div class="modal-footer">
               <button
              type="button"
              class="btn btn-primary"
              data-dismiss="modal"
            >
              Tancar
            </button>
            <button
              id="buttonDeleteModal"
              @click="deleteTipo()"
              type="submit"
              class="btn btn-secondary"
            >
              Esborrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <button
      class="btn btn-primary"
      id="addButton"
      @click="selectAction('afegir')"
    >
      Afegir
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      action: "",
       perPage: 5,
        currentPage: 1,
        totalRows: '',
      tipus_alertants: [],
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
        .get("/tipusalertants")
        .then((response) => {
          me.tipus_alertants = response.data;
          me.totalRows= me.tipus_alertants.length;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => (this.loading = false));
    },
    afegirTipo() {
      let me = this;
       console.log("adding");
      axios
        .post("/tipusalertants", me.tipo)
        .then(function (response) {
          console.log(response);
          me.selectTipus();
          me.tipo =  {
                id: "",
                tipus: "",
            };
           me.action='';
            document.getElementById("addButton").style.display = "block";
        })
        .catch((error) => {
          console.log(error.response.status);
          console.log(error.response.data);
            me.action='';
          // me.errorMessage= error.response.data.error;
        });
    },
    editarTipo() {
         console.log("updating");
      let me = this;
      axios
        .put("/tipusalertants/" + me.tipo.id, me.tipo)
        .then(function (response) {
          console.log(response);
          me.selectTipus();
           me.action='';
            me.tipo =  {
                id: "",
                tipus: "",
            };
        })
        .catch((error) => {
          console.log(error.response.status);
          console.log(error.response.data);
            me.action='';
          // me.errorMessage= error.response.data.error;
        });
    },
    confirmDeleteTipo(tipo) {
      this.tipo = tipo;
      $("#deleteModal").modal("show");
    },
    deleteTipo() {
        console.log("deleting");
      let me = this;
      axios
        .delete("/tipusalertants/" + me.tipo.id)
        .then((response) => {
          me.selectTipus();
          $("#deleteModal").modal("hide");
            me.action='';
          //me.infoMessage= response.data.missatge;
        })
        .catch((error) => {
          //me.errorMessage = error.response.data.error;
          $("#deleteModal").modal("hide");
            me.action='';
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
    }
  },
  created() {
    this.selectTipus();
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
