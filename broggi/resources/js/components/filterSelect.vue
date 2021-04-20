<template>
    <div class="form-group row">
        <label class="col-2" for="rols_id">{{name}}</label>
            <select value="all" class="form-select col-3" v-model="filterSelection"  @change="applyFilter()" aria-label="Default select example">
                <option value="all">Todos</option>
                <option v-for="item in filterBy" :key="item.id"
                v-bind:value="item.id">{{ item[filterField]}}</option>
            </select>
    </div>
</template>

<script>
    export default {
                props: {
        // Lista que va a ser filtrada
        listToFilter: {
            type: Array,
            required: true
        },
        // Array de elementos que se mostrarán en el select
            filterBy: {
            type: Array,
            required: true
        },
        // Nombre de la propiedad del elemento que se va a mostrar en el select
         filterField: {
            type: String,
            required: true
        },
        // Nombre de la propiedad que contiene el id que relaciona el elemento de la array a filtrar con la array que se muestra
        // en el select.
        relatedId: {
            type: String,
            required: true
        },
        // Cosa que vamos a filtrar, para añadir como label del input.
        name: {
            type: String,
            required: true
        }
    },
        data() {
        return {
            filterSelection: '',
            filteredItems: '',
        }
        },
        methods: {
            // Esta función aplica el filtro y transmite al padre.
            applyFilter(){
                this.filteredItems= [];
                if(this.filterSelection ==='all'){
                    this.filteredItems= this.listToFilter;
                }else{
                    this.listToFilter.forEach(item => {
                        if(item[this.relatedId] == this.filterSelection){
                            this.filteredItems.push(item);
                        }
                    });
                }

                  this.$emit('applyFilterResults', this.filteredItems);
            }
        },
        mounted() {
            // console.log('Component mounted.');
        }
    }
</script>
