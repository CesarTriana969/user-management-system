<template>
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th v-if="userHasPermission('delete-role')" scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                            v-model="AllCheck">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="py-3 px-3">
                    ID
                </th>
                <th scope="col" class="py-3 px-6">
                    Role
                </th>

                <th scope="col" class="py-3 px-6">
                </th>
            </tr>
        </thead>
        <NoTableDataComponentVue 
            v-if="shouldShowNoDataComponent" 
            info="Role" 
            cols="3" 
        />
        <tbody v-else>
            <tr class="bg-white border-b hover:bg-gray-50 " 
                v-for="role in roles" 
                :key="role.id"
            >
                <DataTableComponent 
                    @close="$emit('close')" 
                    :role="role" 
                    @checkbox="checkDataUpdate" 
                    :statusC="AllCheck"
                    v-if="!isLoading"
                ></DataTableComponent>
            </tr>
            <template v-if="isLoading">
                <LoadingComponent :times="4"></LoadingComponent>
            </template>
        </tbody>
    </table>
</template>

<script>
import DataTableComponent from './DataTableComponent.vue';
import LoadingComponent from '@/components/LoadingComponent.vue';
import NoTableDataComponentVue from '@/components/NoTableDataComponent.vue';

export default {
    components: { DataTableComponent, LoadingComponent, NoTableDataComponentVue },
    props: {
        roles: {
            type: Object
        },
        emptyCheck: {
            type: Boolean
        },
        isLoading: {
            type: Boolean
        }
    },
    data() {
        return {
            checkData: [],
            AllCheck: false
        }
    },
    computed: {
        permissions() {
            return this.$store.state.permissions
        },
        shouldShowNoDataComponent() {
            return !this.isLoading && (!this.roles || this.roles.length === 0);
        },
    },
    methods: {
        checkDataUpdate(data) {
            if (data.status === false) {
                let exist = this.checkData.find(i => i == data.id)
                if (!exist) {
                    this.checkData.push(data.id)
                }
            } else {
                this.checkData = this.checkData.filter(item => item !== data.id)
            }
            this.$emit('checkbox', this.checkData, data.enabled)
        },
        allChecked() {
            this.AllCheck = !this.AllCheck
        },
        userHasPermission(permissionName) {
            return this.permissions.includes(permissionName);
        },
    },
    watch: {
        emptyCheck() {
            this.AllCheck = false
        }
    }
}
</script>