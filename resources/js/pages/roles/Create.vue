<template>
    <div class="relative shadow-md rounded-3xl p-10 bg-white shade-component"
        style="max-height: 95vh;">

        <h4 class="text-2xl font-bold text-slate-950 max-[768px]:text-xl">Role's Information</h4>

        <div class="">
            <div class="grid gap-10 items-end md:grid-cols-1 mt-10">
                <BaseInput
                    type="text" 
                    v-model="form.name"
                    label="Role's Name"
                    placeholder=" "
                    :error="errors?.name" 
                />
            </div>

            <div class="grid gap-10 items-end md:grid-cols-1 mt-10 mb-4">
                <label for="roles" class="sr-only">Roles</label>
                <VueMultiselect 
                    v-model="form.permissions" 
                    :options="permissions" 
                    :multiple="true" 
                    :taggable="true"
                    :close-on-select="false" 
                    tag-placeholder="Add this as a new tag"
                    placeholder="Type to search or add a tag" 
                    select-label="Select" 
                    deselect-label="Remove"
                    :hide-selected="true" 
                    label="name" 
                    track-by="id"
                >
                </VueMultiselect>
            </div>
        </div>
        <div class="relative flex justify-between gap-3 max-[768px]:flex-col max-[768px]:mt-0">
            <button 
                @click="resetForm"
                class="px-28 py-2 bg-gray-200 rounded-md text-gray-500 font-bold max-[768px]:flex max-[768px]:items-center max-[768px]:justify-center"
            >
                Reset
            </button>
            <button 
                @click="formSave"
                class="px-28 py-2 bg-blue-600 rounded-md font-bold text-white  max-[768px]:flex max-[768px]:items-center max-[768px]:justify-center"
            >
                Create
            </button>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2';
import VueMultiselect from 'vue-multiselect'
import TitleComponent from '@/components/TitleComponent.vue';
import BaseInput from '@/components/BaseInput.vue';

export default {
    components: { VueMultiselect, TitleComponent, BaseInput },
    data() {
        return {
            form: {
                name: '',
                permissions: []
            },
            permissions: [],
            errors: {}, 
        }
    },
    created() {
        this.getPermissions()
    },
    methods: {
        async getPermissions() {
            await axios.get("/system/get/all/permissions")
                .then((response) => {
                    this.permissions = response.data.data
                })
                .catch((error) => {
                    console.log(error);
                });
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
        async formSave() {
            this.showAlertLoading("info", "Saving...", "Please wait...", {
                showConfirmButton: false,
                allowOutsideClick: false,
                willOpen: () => {
                    Swal.showLoading();
                },
            });
            const formData = new FormData();
            formData.append("name", this.form.name);
            for (let i = 0; i < this.form.permissions.length; i++) {
                formData.append("permission[]", this.form.permissions[i]['id']);
            }

            await axios.post('/system/role/store', formData)
                .then((response) => {
                    let message = response.data.message;
                    this.form.name = '';
                    this.form.permissions = ''
                    Swal.close();
                    this.showAlert("success", "Perfect.", message);
                    this.$emit('close');
                })
                .catch(error => {
                    Swal.close()
                    let errorMessage = error.response.data.message || "Unknown error";
                    this.showAlert("error", "error.", errorMessage);
                })
        },
        resetForm() {
            this.form.name = '';
            this.form.permissions = ''
        },
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<style>
.multiselect__option--highlight:after {
    content: attr(data-select);
    background: gray;
    color: #fff;
}
.multiselect__option--highlight {
    background: gray;
}
.multiselect__tag {
    background: gray;
}
</style>