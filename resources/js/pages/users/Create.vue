<template>
    <div class="relative shadow-md rounded-3xl p-10 bg-white shade-component"
        style="max-height: 95vh;">

        <h4 class="text-2xl font-bold text-slate-950 max-[768px]:text-xl">User's Information </h4>

        <div class="popUp__system">
            <div class="grid gap-10 items-end md:grid-cols-2 mt-10">
                <BaseInput
                    type="text" 
                    v-model="form.name"
                    label="First Name"
                    placeholder=" "
                    :error="errors?.name" 
                />
                <BaseInput
                    type="text" 
                    v-model="form.last_name"
                    label="Last Name"
                    placeholder=" "
                    :error="errors?.last_name" 
                />
                <BaseInput
                    type="email" 
                    v-model="form.email"
                    label="Email"
                    placeholder=" "
                    :error="errors?.email" 
                />
                <BaseInput
                    type="tel" 
                    v-model="form.phone"
                    label="Phone Number"
                    placeholder=" "
                    :error="errors?.phone" 
                />
            </div>

            <div class="grid gap-10 items-end md:grid-cols-2 mt-10">
                <BaseInput
                    type="password" 
                    v-model="form.password"
                    label="Password"
                    placeholder=" "
                    :error="errors?.password" 
                />
                <BaseInput
                    type="password" 
                    v-model="form.confirmPassword"
                    label="Repeat password"
                    placeholder=" "
                    :error="errors?.confirmPassword" 
                />
            </div>

            <div class="grid gap-10 items-end md:grid-cols-2 mt-10">
                <label for="roles" class="sr-only">Roles</label>
                <select 
                    v-model="form.role" 
                    id="roles" 
                    name="roles"
                    class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                    <option value="" selected="selected">Select</option>
                    <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                </select>
            </div>
        </div>
        <div class="relative flex justify-between mt-5 gap-3 max-[768px]:flex-col max-[768px]:mt-0">
            <button @click="resetForm"
                class="px-28 py-2 bg-gray-200 rounded-md text-gray-500 font-bold max-[768px]:flex max-[768px]:items-center max-[768px]:justify-center">
                Reset
            </button>
            <button @click="formSave"
                class="px-28 py-2 bg-blue-600 rounded-md font-bold text-white  max-[768px]:flex max-[768px]:items-center max-[768px]:justify-center">
                Create
            </button>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2';
import TitleComponent from '@/components/TitleComponent.vue';
import BaseInput from '@/components/BaseInput.vue';

export default {
    components: { TitleComponent,BaseInput },
    data() {
        return {
            form: {
                name: '',
                last_name: '',
                email: '',
                phone: '',
                password: '',
                confirmPassword: '',
                role: ''
            },
            roles: [],
            errors: {}, 
        }
    },
    created() {
        this.getRoles()
    },
    methods: {
        async getRoles() {
            await axios.get("/system/get/names-roles")
                .then((response) => {
                    this.roles = response.data.data
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
            formData.append("last_name", this.form.last_name);
            formData.append("email", this.form.email);
            formData.append("phone", this.form.phone);
            formData.append("password", this.form.password);
            formData.append("password_confirmation", this.form.confirmPassword);
            formData.append("roles", this.form.role);

            await axios.post('/system/user/store', formData)
                .then((response) => {
                    let message = response.data.message;
                    this.form.name = '';
                    this.form.last_name = '';
                    this.form.email = '';
                    this.form.phone = '';
                    this.form.password = '';
                    this.form.confirmPassword = '';
                    this.form.role = ''
                    Swal.close()
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
            this.form.last_name = '';
            this.form.email = '';
            this.form.phone = '';
            this.form.password = '';
            this.form.confirmPassword = '';
            this.form.role = ''
        }
    }
}
</script>

<style>
@media (width <=1150px) {
    .popUp__system {
        min-width: 100%;
        max-width: 100%;
        max-height: 65vh;
        overflow: auto;
        padding-bottom: 40px;
    }

    .popUp__system::-webkit-scrollbar {
        width: 8px;
    }

    .popUp__system::-webkit-scrollbar-thumb {
        background-color: #E0E0E0;
        border-radius: 4px;
    }
}
</style>
