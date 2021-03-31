<template>
    <div class="form-group row">
        <label class="col-2" for="rols_id">Rol:</label>
            <select class="form-select col-3" v-model="filterSelection"  @change="applyFilter()" aria-label="Default select example">
                <option value="all">Todos</option>
                <option v-for="item in filterBy" :key="item.id"
                v-bind:value="item.id">{{ item[filterField]}}</option>
            </select>
    </div>
</template>

<script>
    export default {
                props: {
        listToFilter: {
            type: Array,
            required: true
        },
            filterBy: {
            type: Array,
            required: true
        },
         filterField: {
            type: String,
            required: true
        }
    },
        data() {
        return {
            filterSelection: '',
            filteredItems: ''
        }
        },
        methods: {
            applyFilter(){
                this.filteredItems= [];
                if(this.filterSelection ==='all'){
                    this.filteredItems= this.listToFilter;
                }else{
                    this.props.listToFilter.forEach(item => {
                        if(item[this.filterField]== this.filterSelection){
                            this.filteredItems.push(item);
                        }
                    });
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>