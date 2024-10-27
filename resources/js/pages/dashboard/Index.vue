<template>
    <p class="text-4xl text-gray-900 mb-10">Dashboard</p>

    <div class="flex max-[768px]:flex-col max-[768px]:gap-3">
        <div class="px-4 pt-5 ml-3 max-[768px]:ml-0 pb-1 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md ">
            <div class="flex justify-between">
                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 ">Users</h5>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-leads" width="35" height="35" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <rect x="4" y="4" width="6" height="6" rx="1" />
                    <rect x="14" y="4" width="6" height="6" rx="0" />
                    <rect x="4" y="14" width="6" height="6" rx="1" />
                    <line x1="20" y1="14" x2="20" y2="14.01" />
                    <line x1="14" y1="20" x2="17" y2="20" />
                    <line x1="17" y1="17" x2="20" y2="17" />
                    <line x1="20" y1="17" x2="20" y2="20" />
                </svg>
              
            </div>
            <p class="mb-3 mt-5 font-normal text-gray-500 mr-40">All Users</p>
           
            <h5 class="mt-5 text-4xl font-semibold tracking-tight text-gray-900  text-end">{{users}}</h5>
        </div>
    </div>
    <br>
    <br><br>
</template>

<script>

export default {
    props:{
        users: Number,
    },
    data(){
         return{
            menu: false,
         }
     },
     computed:{
        permissions() {
            return this.$store.state.permissions
        },
     },
     created(){
     },
     methods:{
        userHasPermission(permissionName) {
            return this.permissions.includes(permissionName);
        },
     }
}
</script>