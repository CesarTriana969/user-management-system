<template>
    <td v-if="roleHasPermission('delete-role')" class="p-4 w-4">
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
        #{{ role.id }}
    </td>
    <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap">
        <div class="pl-3">
            <div class="text-base font-semibold">{{ role.name }}</div>
        </div>
    </th>

    <td v-if="roleHasPermission('edit-role')" class="py-4 px-6">
        <PopUp @close="handlePopUp" :showPopUp="showPopUp">
            <EditComponent 
                :role="role" 
                @close="$emit('close')"
            ></EditComponent>
        </PopUp>

        <button 
            @click="handlePopUp" 
            type="button" 
            class="font-medium text-blue-600 hover:underline"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="22" height="22"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                <line x1="16" y1="5" x2="19" y2="8" />
            </svg>
        </button>
    </td>
</template>

<script>
import { ref } from "vue";
import PopUp from "@/components/PopUpComponent.vue";
import EditComponent from "./EditComponent.vue";

export default {
    components: {
        PopUp,
        EditComponent
    },
    props: {
        role: {
            type: Object
        },
        statusC: {
            type: Boolean,
        }
    },
    data() {
        return {
            checkbox: {
                status: this.statusC,
                id: this.role.id,
                enabled: this.role.enabled
            }
        }
    },
    computed: {
        permissions() {
            return this.$store.state.permissions
        },
    },
    setup() {
        const showPopUp = ref(false);

        const handlePopUp = () => {
            showPopUp.value = !showPopUp.value;
        };

        return { showPopUp, handlePopUp };
    },
    watch: {
        statusC() {
            this.$emit('checkbox', this.checkbox)
            this.checkbox.status = this.statusC
        },
    },
    methods: {
        roleHasPermission(permissionName) {
            return this.permissions.includes(permissionName);
        },
    }
}
</script>