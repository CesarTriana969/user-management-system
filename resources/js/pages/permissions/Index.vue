<template>
    <p class="text-4xl text-gray-900 mt-5">Permisos</p>

    <div class=" relative sm:rounded-lg px-5 bg-white mt-10 shade-component">
        <div class="flex justify-between items-center pb-5 pt-5 bg-white">
            <div style="display:flex">
                <div style="position:relative">
                    <button v-if="order == 'asc'" @click="orderDropdown = !orderDropdown" class="inline-flex items-center text-gray-500 capitalize   bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 " type="button">
                        <svg class="mr-2 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                        Ascendente
                        <svg class="ml-2 w-3 h-3" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <button v-if="order == 'desc'" @click="orderDropdown = !orderDropdown" class="inline-flex items-center text-gray-500 capitalize   bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5" type="button">
                        <svg class="mr-2 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                        Descendente
                        <svg class="ml-2 w-3 h-3" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div v-show="orderDropdown" class="z-10 w-48 bg-white rounded divide-y divide-gray-100 shadow " style="position: absolute; margin: 0px; transform: translate3d(0, 5px, 0px);">
                        <ul class="p-3 space-y-1 text-sm text-gray-700" aria-labelledby="dropdownRadioButton">
                            <li>
                                <div  class="flex items-center  p-2 rounded hover:bg-gray-100 ">
                                    <input id="filter-radio-example-1" @click="order = 'asc'"  type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2 ">
                                    <label for="filter-radio-example-1" class="ml-2 w-full text-sm font-medium text-gray-900 rounded ">Ascendente</label>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 ">
                                    <input checked=""  @click="order = 'desc'" id="filter-radio-example-2"  type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2 ">
                                    <label for="filter-radio-example-2" class="ml-2 w-full text-sm font-medium text-gray-900 rounded ">Descendente</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <button 
                    v-show="checkData.length > 0"
                    class="inline-flex items-center ml-3 text-red-500 bg-white border border-red-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5" type="button">
                    Eliminar
                </button>
                <button 
                    v-show="checkData.length > 0 && enabled == 1"
                    class="inline-flex items-center ml-3 text-blue-500 bg-white border border-blue-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5" type="button">
                    Bloquear
                </button>
                <button 
                    v-show="checkData.length > 0 && enabled == 0"
                    class="inline-flex items-center ml-3 text-blue-500 bg-white border border-blue-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5" type="button">
                    Desbloquear
                </button>
            </div>
            <label for="table-search" class="sr-only">Buscar</label>
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" 
                    id="table-search-users" 
                    class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " 
                    placeholder="Buscar usuarios"
                    v-model="search"
                >
            </div>
        </div>
        <TableComponent 
            :users="users"
            @checkbox="checkDataUpdate"
            :emptyCheck="emptyCheck"
            :isLoading="isLoading"
        >
        </TableComponent>
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </a>
                <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </a>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                <p class="text-sm text-gray-700">
                    Mostrando
                    <span class="font-medium">{{dataComplet.from}}</span>
                    a
                    <span class="font-medium">{{dataComplet.last_page}}</span>
                    de
                    <span class="font-medium">{{dataComplet.total}}</span>
                    resultados
                </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination"
                       
                    >
                        <template 
                            v-for="(pagination, id) in dataComplet.links" :key="id"
                            
                            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        
                            <button href="#" aria-current="page" :class="[
                                    '  relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                                    pagination.active ? 'z-10 bg-gray-200 border-gray-800 text-gray-800 relative inline-flex items-center px-4 py-2 border text-sm font-medium' :  'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium'
                                ]"
                                @click="getData(pagination.url)"
                                v-html="pagination.label"
                            >  </button>
                
                        </template>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</template>

<script>
import TableComponent from './components/TableComponent.vue';
export default {
    components: { TableComponent },
     data() {
        return {
            search: "",
            users: [],
            dataComplet: [],
            order: 'desc',
            checkData: [],
            emptyCheck: false,
            enabled: 1,
            orderDropdown: false,
            isLoading: false
        }
     },
    created(){
       this.getData()
    },
    watch:{
        search() {
            this.getData()
        },
        order(){
            this.getData()
        }
    },
    methods: {
        async getData(urlData) {
            this.isLoading = true
            this.checkData.length = 0
            this.emptyCheck = !this.emptyCheck
            let url = urlData === undefined ? "/get/permissions" : urlData;
            await axios.get(url, {
                params: {
                    "search": this.search,
                    "order": this.order
                }
            })
                .then((response) => {
                    this.isLoading = false
                    this.users = response.data.data;
                    this.dataComplet = response.data;
            })
                .catch((error) => {
                    console.log(error);
            });
        },
        checkDataUpdate(data, enabled){
            this.checkData = data
            this.enabled = enabled
            console.log(this.enabled)
        }
    }
}
</script>

<style>

</style>