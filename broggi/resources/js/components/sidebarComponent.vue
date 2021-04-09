<template>
<div class="nav-side my-5 pt-5 col-2 position-absolute fixed-top sticky-left align-items-center" style="top:0;">
    <div id="logoSide" class="align-items-center col-2">
        <img src="/Project2/broggi/public/img/asideLogo.png" class="align-items-center" height="128.15" width="170">
    </div>
    <div class="mt-5">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <!-- align-items-center -->
            <ul id="side-menu nav-pills" class="nav flex-column " >
                <li v-for="item in selectedList" @click="changeSection(item)" :key="item" class="sidebar mb-2">
                    <a v-bind:class="{ active: item == selectedSection }" class="nav-link"  data-toggle="pill" href="#" role="tab" aria-controls="v-pills-home" aria-selected="true"> {{item}}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: {
        page: {
            type: String,
            required: true
        }
    },
        data() {
        return {
            recursos: [ 'Recursos' , 'Tipus de Recursos'],
            selectedList: [],
            selectedSection: ''
        }
    },
    methods: {
        // Todas las páginas que gestiona la navbar y los apartados que ha de mostrar en la sidebar.
        addSection(){
            switch (this.page) {
                case 'recursos':
                    this.selectedList = this.recursos;
        // Por defecto se mostrará primero la primera opción
                    this.selectedSection= this.selectedList[0]
                    break;

                default:
                    break;
            }
        },
        changeSection(item){
            this.selectedSection= item;
            this.$emit('changeOption', this.selectedSection);
        }
    },
        mounted() {
            console.log('Component mounted.')
            this.addSection();
        }
    }
</script>
