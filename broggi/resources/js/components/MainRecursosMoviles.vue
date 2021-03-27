<template>
    <div class="recursosMovilsContainer">
        <button type="button" @click="selectAction('afegir')" class="btn btn-primary">Afegir</button>
        <!-- Si no se selecciona una opción, se muestra la tabla -->
        <table v-show="action == ''" class="table">
            <thead>
                <tr>
                    <th scope="col">Codi</th>
                    <th scope="col">Actiu</th>
                    <th scope="col">Tipus</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="recurs in recursos" :key="recurs.id">
                    <td>{{ recurs.codi }}</td>
                    <td>
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                value="actiu"
                                id="actiu"
                                :checked="recurs.actiu"
                            />
                            <label class="form-check-label" for="actiu"></label>
                        </div>
                    </td>

                    <td>{{ recurs.tipus_recursos_id.tipus }}</td>

                    <td>
                        <button
                            type="submit"
                            class="btn btn-warning btn-sm d-flex"
                        >
                            <i class="fas fa-edit"></i> Editar
                        </button>
                    </td>
                    <td>
                        <button
                            id="deleteB"
                            type="submit"
                            class="btn btn-secondary btn-sm d-flex"
                        >
                            <i class="fas fa-trash"></i> Esborrar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Si se selecciona la opción añadir, se muestra el formulario -->
        <div v-show="action == 'afegir'">
            <div class="form-group row">
                <label class="col-2" for="codi">Codi</label>
                <input v-model="recurs.codi" class="col-10" type="text" id="codi" name="codi" />
            </div>
            <div class="form-check">
                <label class="form-check-label col-2" for="actiu">Actiu</label>
                <input
                    class="form-check-input"
                    type="checkbox"
                    value="actiu"
                     v-model="recurs.actiu"
                    id="actiu"
                />
            </div>
            <div class="form-group row">
            <label class="col-2" for="tipus_rescurs_id">Tipus</label>
            <select class="form-select" v-model="recurs.tipus_recursos_id" aria-label="Default select example">
                <option v-for="recurso in tipus_recursos" :key="recurso.id" v-bind:value="recurso.id" >{{recurso.tipus}}</option>
            </select>
            </div>


            <button type="button" @click="afegirRecurs()" class="btn btn-primary">Afegir</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            action: "",
            recursos: [],
            tipus_recursos:[],
            recurs: {
                id: '',
                codi: '',
                actiu: '',
                tipus_recursos_id: '',
                lat: '',
                lon: ''
            }
        };
    },
    methods: {
        selectCicles() {
            let me = this;
            axios
                .get("/recursos")
                .then(response => {
                    me.recursos = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => (this.loading = false));
        },
        selectAction(action) {
            this.action = action;
        },
        selectTipus(){
             let me = this;
            axios
                .get("/tipusrecursos")
                .then(response => {
                    me.tipus_recursos = response.data;
                    console.log(me.tipus_recursos);
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => (this.loading = false));
        },
        afegirRecurs(){

        }
    },
    created() {
        this.selectCicles();
        this.selectTipus();
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
