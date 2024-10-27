<template>
        <title-component title="Users"
            :links="[
                { text: 'Users', href: '/system/users' },
                { text: 'Data', href: '/system/users' }
            ]"
        ></title-component>

        <div class="lg:w-12/12 relative shadow-md sm:rounded-lg px-5 mt-6 bg-white shade-component">
            <div class="flex justify-between items-center pb-5 pt-5 bg-white max-[768px]:flex-col  max-[768px]:items-end">

                <PopUp @close="handlePopUp" :showPopUp="showPopUp">
                    <CreateUser @close="closeCreateModal"></CreateUser>
                </PopUp>

                <div class="flex flex-row items-center gap-2 max-[768px]:mb-2">

                    <button 
                        v-if="userHasPermission('create-user')" 
                        @click="handlePopUp" 
                        type="button" 
                        class="px-4 py-2 bg-blue-600 rounded-md font-bold text-white"
                    >Create</button>
    
                    <div style="display:flex">
                        <button 
                            v-if="userHasPermission('delete-user')"
                            v-show="checkData.length > 0"
                            @click="deleteUser"
                            class="px-4 py-2 bg-red-600 rounded-md font-bold text-white"  
                            type="button"
                            >
                            Delete
                        </button>
                    </div>
                </div>

                <label for="table-search" class="sr-only">Search</label>
                <div class="relative max-[768px]:w-full">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 " aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" 
                        id="table-search-users" 
                        class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 max-[768px]:w-full" 
                        placeholder="Search user"
                        v-model="search"
                        autocomplete="off"
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
            <PaginationComponent :dataComplet="dataComplet" @getData="getData"></PaginationComponent>
        </div>
    <br><br>
     
</template>

<script>
import { ref } from "vue";
import PopUp from "@/components/PopUpComponent.vue";
import CreateUser from './Create.vue';

import TableComponent from './components/TableComponent.vue';
import PaginationComponent from '@/components/PaginationComponent.vue';
import TitleComponent from '@/components/TitleComponent.vue';
import Swal from 'sweetalert2/dist/sweetalert2.js';
import 'sweetalert2/src/sweetalert2.scss';

export default {
    components: { 
        TableComponent, 
        PaginationComponent, 
        TitleComponent,
        PopUp,
        CreateUser
    },
    setup() {
        const showPopUp = ref(false);

        const handlePopUp = () => {
        showPopUp.value = !showPopUp.value;
    };

        return { showPopUp, handlePopUp };
    },
    data() {
        return {
            search: "",
            users: [],
            dataComplet: [],
            checkData: [],
            emptyCheck: false,
            enabled: 1,
            isLoading: false,
            order: 'desc',
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
        },
    },
    computed:{
        permissions() {
            return this.$store.state.permissions
        },
     },
    methods: {
        closeCreateModal(){
            this.handlePopUp();
            this.getData();
        },
        showAlertLoading(icon, title, text, options) {
            Swal.fire({
                icon: icon,
                title: title,
                text: text,
                customClass: {
                    container: 'validation__message-container',
                    popup: 'validation__message-popUp',
                    title: 'validation__message-title',
                    content: 'validation__message-content',
                    icon: 'validation__message-icon',
                },
                ...options,
            });
        },
        showAlert(icon, title, text) {
            Swal.fire({
                icon: icon,
                title: title,
                text: text,
                customClass: {
                    container: 'validation__message-container',
                    popup: 'validation__message-popUp',
                    title: 'validation__message-title',
                    content: 'validation__message-content',
                    icon: 'validation__message-icon',
                    confirmButton: 'validation__message-btn',
                },
            });
        },
        async getData(urlData) {
            this.checkData = [] 
            this.users = [],
            this.dataComplet = [],
            this.isLoading = true
            this.checkData.length = 0
            this.emptyCheck = !this.emptyCheck
            let url = urlData === undefined ? "/system/get/users" : urlData;
            await axios.get(url, {
                params: {
                    "search": this.search,
                    "order": this.order,
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
        }, 
        orderMethod(data){
            this.order = data;
        },
        
        async deleteUser(){
            this.showAlertLoading("info", "Saving...", "Please wait...", {
                showConfirmButton: false,
                allowOutsideClick: false,
                willOpen: () => {
                    Swal.showLoading();
                },
            });
            const formData = new FormData();
            formData.append('users', JSON.stringify(this.checkData))
            await axios.post(`/system/user/delete`,formData)
                .then((response) => {
                    console.log(response)
                    let message = response.data.message;
                    this.showAlert("success", "Deleted.", message);
                    this.getData();
                    this.$store.dispatch('setClearCheckData', 1);
                })
                .catch((error) => {
                    this.showAlert("error", "error.", error);
                });
        },
        userHasPermission(permissionName) {
            return this.permissions.includes(permissionName);
        },
    }
}
</script>

<style>

</style>