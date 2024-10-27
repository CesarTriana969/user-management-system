<template>
    <title-component title="Roles" :links="[
        { text: 'Roles', href: '/system/roles' },
        { text: 'Data', href: '/system/roles' }
    ]"></title-component>

    <div class="lg:w-12/12 relative shadow-md sm:rounded-lg px-5 mt-6 bg-white shade-component">
        <div class="flex justify-between items-center pb-5 pt-5 bg-white max-[768px]:flex-col max-[768px]:items-end">
            <div class="flex flex-row items-center gap-3.5 max-[768px]:flex-col max-[768px]:items-end">

                <PopUp 
                    @close="handlePopUp" 
                    :showPopUp="showPopUp"
                >
                    <CreateRole @close="closeCreateModal"></CreateRole>
                </PopUp>

                <button 
                    v-if="userHasPermission('create-role')" 
                    @click="handlePopUp" 
                    type="button"
                    class="px-4 py-2 bg-blue-600 rounded-md font-bold text-white"
                >Create</button>

                <div style="display:flex" class="flex flex-row items-center gap-2 max-[768px]:mb-2">
                    <div style="position:relative">
                        <button 
                            v-if="order == 'asc'" 
                            @click="orderDropdown = !orderDropdown"
                            class="inline-flex items-center text-gray-500 capitalize   bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5"
                            type="button"
                        >
                            <svg class="mr-2 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                            </svg>
                            Ascending
                            <svg class="ml-2 w-3 h-3" aria-hidden="true" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <button 
                            v-if="order == 'desc'" 
                            @click="orderDropdown = !orderDropdown"
                            class="inline-flex items-center text-gray-500 capitalize   bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5"
                            type="button"
                        >
                            <svg class="mr-2 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
                            </svg>
                            Descending
                            <svg class="ml-2 w-3 h-3" aria-hidden="true" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div v-show="orderDropdown" class="z-10 w-48 bg-white rounded divide-y divide-gray-100 shadow"
                            style="position: absolute; margin: 0px; transform: translate3d(0, 5px, 0px);">
                            <ul class="p-3 space-y-1 text-sm text-gray-700" aria-labelledby="dropdownRadioButton">
                                <li>
                                    <div class="flex items-center  p-2 rounded hover:bg-gray-100">
                                        <input 
                                            id="filter-radio-example-1" 
                                            @click="order = 'asc'" 
                                            type="radio" 
                                            value=""
                                            name="filter-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 ">
                                        <label for="filter-radio-example-1"
                                            class="ml-2 w-full text-sm font-medium text-gray-900 rounded">Ascending</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100 ">
                                        <input 
                                            checked="" 
                                            @click="order = 'desc'" 
                                            id="filter-radio-example-2"
                                            type="radio" value="" name="filter-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 "
                                        >
                                        <label for="filter-radio-example-2"
                                            class="ml-2 w-full text-sm font-medium text-gray-900 rounded ">Descending</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <button 
                        v-if="userHasPermission('delete-role')" 
                        v-show="checkData.length > 0"
                        class="px-4 py-2 bg-red-600 rounded-md font-bold text-white" 
                        type="button"
                        @click="deleteRole"
                    >
                        Delete
                    </button>
                </div>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative  max-[768px]:w-full">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input 
                    type="text" 
                    id="table-search-users"
                    class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 max-[768px]:w-full"
                    placeholder="Search Role" 
                    v-model="search"
                >
            </div>
        </div>
        <TableComponent 
            :roles="roles" 
            @checkbox="checkDataUpdate" 
            :emptyCheck="emptyCheck" 
            :isLoading="isLoading"
            @close="getData"
        >
        </TableComponent>
        <PaginationComponent 
            :dataComplet="dataComplet" 
            @getData="getData"
        ></PaginationComponent>
    </div>
    <br><br>
</template>

<script>
import { ref } from "vue";
import Swal from 'sweetalert2';
import PopUp from "@/components/PopUpComponent.vue";
import CreateRole from './Create.vue';
import TableComponent from './components/TableComponent.vue';
import TitleComponent from '@/components/TitleComponent.vue';
import PaginationComponent from '@/components/PaginationComponent.vue';

export default {
    components: {
        TableComponent,
        TitleComponent,
        PaginationComponent,
        PopUp,
        CreateRole
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
            roles: [],
            dataComplet: [],
            order: 'desc',
            checkData: [],
            emptyCheck: false,
            enabled: 1,
            orderDropdown: false,
            isLoading: false
        }
    },
    created() {
        this.getData()
    },
    watch: {
        search() {
            this.getData()
        },
        order() {
            this.getData()
        }
    },
    computed: {
        permissions() {
            return this.$store.state.permissions
        },
    },
    methods: {
        closeCreateModal() {
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
            this.isLoading = true
            this.checkData.length = 0
            this.emptyCheck = !this.emptyCheck
            let url = urlData === undefined ? "/system/get/roles" : urlData;
            await axios.get(url, {
                params: {
                    "search": this.search,
                    "order": this.order
                }
            })
                .then((response) => {
                    this.isLoading = false
                    this.roles = response.data.data;
                    this.dataComplet = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        checkDataUpdate(data, enabled) {
            this.checkData = data
            this.enabled = enabled
            console.log(this.enabled)
        },
        async deleteRole() {
            this.showAlertLoading("info", "Saving...", "Please wait...", {
                showConfirmButton: false,
                allowOutsideClick: false,
                willOpen: () => {
                    Swal.showLoading();
                },
            });

            const formData = new FormData();
            formData.append('roles', JSON.stringify(this.checkData))
            await axios.post(`/system/role/delete`, formData)
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