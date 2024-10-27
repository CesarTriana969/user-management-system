<template>
   <td v-if="userHasPermission('delete-user')" class="p-4 w-4">
        <div class="flex items-center">
            <input 
                id="checkbox-table-search-1" 
                type="checkbox" 
                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2 "
                @click="$emit('checkbox', checkbox)"
                v-model="checkbox.status"
            >
            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
        </div>
    </td>
    <td class="py-4 px-3 font-semibold">
        #{{user.id}}
    </td>
    <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap">
        <div class="pl-3">
            <div class="text-base font-semibold">{{user.name}}</div>
            <div class="font-normal text-gray-500">{{user.email}}</div>
        </div>  
    </th>
    <td class="py-4 px-6">
        <span v-if="user.roles.length > 0" class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
            {{user.roles[0].name}}
        </span>
    </td>
    <td v-if="userHasPermission('edit-user')" class="py-4 px-6">
        <a :href="'/system/user/edit/'+user.id" class="font-medium text-blue-600  hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="22" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                <line x1="16" y1="5" x2="19" y2="8" />
            </svg>
        </a>
    </td>
</template>

<script>
export default {
    props:{
        user:{
            type:Object
        },
        statusC: {
            type: Boolean,
        }
    },
    computed:{
        permissions() {
            return this.$store.state.permissions
        },
     },
    data(){
        return{
            checkbox: {
                status: this.statusC,
                id: this.user.id,
                enabled: this.user.enabled
            }
        }
    },
    watch:{
        statusC(){
            this.$emit('checkbox', this.checkbox)
            this.checkbox.status = this.statusC
        },
    },
    methods:{
        userHasPermission(permissionName) {
            return this.permissions.includes(permissionName);
        },
    }
}
</script>