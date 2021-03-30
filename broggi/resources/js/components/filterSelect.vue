<template>
    <div class="form-group row">
        <label class="col-2" for="rols_id">Rol:</label>
            <select class="form-select col-3" v-model="rolToFilter" aria-label="Default select example">
                <option value="all">Todos</option>
                <option v-for="item in listToFilter" :key="item.id"
                v-bind:value="item.id"></option>
            </select>
    </div>
</template>

<script>
    export default {
        data() {
        return {
            rolToFilter: ''
        }
        },
        props: {
        listToFilter: {
            type: Array,
            required: true
        }
    },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>