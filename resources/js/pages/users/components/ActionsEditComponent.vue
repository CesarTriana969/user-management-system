<template>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg p-5 bg-white mt-5 shade-component">
        <h4 class="text-xl font-bold mb-5">Actions</h4>
        <div class="grid items-end md:grid-cols-1 mt-5 mb-5">
            <h5 class="text-lg font-bold">Reset user password</h5>
            <p >Enter the current password and add a new one</p>
            <button
                class="mt-4 inline-flex items-center w-64 bg-gray-100 text-gray-800 border border-gray-500 focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-200 font-medium 
                rounded-lg text-sm px-3 py-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock mr-3" width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <rect x="5" y="11" width="14" height="10" rx="2" />
                  <circle cx="12" cy="16" r="1" />
                  <path d="M8 11v-4a4 4 0 0 1 8 0v4" />
                </svg>
                Reset password
            </button>
        </div>
        <hr>
        <h5 class="text-lg font-bold text-red-600 my-5">Danger Zone</h5>
        <div class="grid items-end md:grid-cols-1 mt-5 mb-5">
            <p>Delete the user completely.</p>
            <button 
                class="inline-flex items-center mt-4 w-32 text-red-500 bg-white border border-red-300 focus:outline-none hover:bg-gray-100 focus:ring-4 
                focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5" type="button"
                @click="deleteUser"
                >
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-off mr-3" width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#EF4444" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <line x1="3" y1="3" x2="21" y2="21" />
                    <path d="M4 7h3m4 0h9" />
                    <line x1="10" y1="11" x2="10" y2="17" />
                    <line x1="14" y1="14" x2="14" y2="17" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l.077 -.923" />
                    <line x1="18.384" y1="14.373" x2="19" y2="7" />
                    <path d="M9 5v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                </svg>
                Delete
            </button>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'

export default {
    props: {
        user: {
            type: Object
        },
    },
    data(){
        return{
            checkData: [this.user.id],
            enabled: this.user.enabled
        }
    },
    methods:{
        async deleteUser(){
            const formData = new FormData();
            formData.append('users', JSON.stringify(this.checkData))
            await axios.post(`/user/delete`,formData)
                .then((response) => {
                    console.log(response)
                    Swal.fire(
                        'Deleted!',
                        'User deleted.',
                        'success'
                     ).then((response) => {
                        location.href ='/users';
                    })
                    this.getData()
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    }
}
</script>

<style>

</style>