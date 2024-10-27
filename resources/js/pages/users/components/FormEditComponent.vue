<template>
    <div class="lg:w-12/12 relative min-[1150px]:shadow-md sm:rounded-lg mt-6 py-8 bg-white px-5  max-[1150px]:py-5 min-[1150px]:shade-component">

        <h4 class="font-bold text-[#3074D3] text-base text-center">Account Information</h4>

        <div class="w-full my-0 mx-auto mt-5 flex flex-col gap-10 items-center border-b border-b-[#D9D9D9] pb-10">
            <div class="grid grid-cols-2 gap-5 w-[90%] max-[1150px]:grid-cols-1 max-[1150px]:w-full">
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

            <BaseBtn 
                @click="formUpdate" 
                text="Save Changes" 
                class="px-28 py-2 bg-[#FFFFFF] rounded-md font-bold text-[#3074D3] max-[768px]:flex max-[768px]:items-center max-[768px]:justify-center border border-[#3074D3] max-[1150px]:px-6 max-[1150px]:text-sm"
            />
        </div>

        <div class="w-full my-0 mx-auto mt-5 flex flex-col gap-10 items-center border-b-2 border-b-[#3074D3] pb-10">
            <h4 class="font-bold text-[#3074D3] text-base text-center">Reset Password</h4>
            <div class="w-full my-0 mx-auto mt-5 flex flex-col gap-10 items-center">
                <div class="grid grid-cols-2 gap-5 w-[90%] max-[1150px]:grid-cols-1">
                    <BaseInput
                        type="password" 
                        v-model="form.current_password"
                        label="Current Password"
                        placeholder=" "
                        :error="errors?.current_password" 
                    />
                    <div class="grid grid-cols-2 gap-2 max-[1150px]:grid-cols-1 max-[1150px]:gap-5">
                        <BaseInput
                            type="password" 
                            v-model="form.password"
                            label="New Password"
                            placeholder=" "
                            :error="errors?.password" 
                        />
                        <BaseInput
                            type="password" 
                            v-model="form.confirm_password"
                            label="Confirm Password"
                            placeholder=" "
                            :error="errors?.confirm_password" 
                        />
                    </div>
                </div>
                <BaseBtn 
                    @click="updatePassword"
                    text="Change Password" 
                    class="px-28 py-2 bg-[#FFFFFF] rounded-md font-bold text-[#3074D3] max-[768px]:flex max-[768px]:items-center max-[768px]:justify-center border border-[#3074D3] max-[1150px]:px-6 max-[1150px]:text-sm"
                />
            </div>
        </div>

        <div class="w-full my-0 mx-auto mt-5 flex flex-col gap-5 items-center">
            <h4 class="font-bold text-[#3074D3] text-base text-center">Danger Zone</h4>
            <p class="font-bold text-[#8E8E8E] text-base text-center">Delete the user completely.</p>

            <button @click="deleteUser" class="px-4 py-2 bg-[#FFFFFF] rounded-md font-bold text-[#3074D3] max-[768px]:flex max-[768px]:items-center max-[768px]:justify-center border border-[#3074D3] flex flex-row items-center gap-1">

                <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    width="25" 
                    height="25" 
                    class="icon icon-tabler icon-tabler-trash-off mr-3" stroke-width="1.5" stroke="#3074D3" fill="none" stroke-linecap="round" 
                    stroke-linejoin="round" 
                    viewBox="2.25 2.25 19.5 19.5"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="3" y1="3" x2="21" y2="21"></line><path d="M4 7h3m4 0h9"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="14" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l.077 -.923"></path><line x1="18.384" y1="14.373" x2="19" y2="7"></line><path d="M9 5v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                </svg>

                Delete
            </button>
        </div>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<script>
import Swal from 'sweetalert2';
import Multiselect from 'vue-multiselect';
import BaseInput from '@/components/BaseInput.vue';
import BaseBtn from '@/components/BaseBtn.vue';

export default {
    components: {
        Multiselect,
        BaseInput,
        BaseBtn
    },
    props: {
        user: {
            type: Object
        },
    },
    data() {
        return {
            options: [],
            form: {
                id: this.user.id,
                name: this.user.name,
                last_name: this.user.last_name,
                email: this.user.email,
                phone: this.user.phone,
                current_password: '',
                password: '',
                confirm_password: '',
                role: this.user.roles[0] ? this.user.roles[0].id : ''
            },
            roles: [],
            hasAdminAccess: this.user.roles.length > 0 ? true : false,
            errors: {}, 
        }
    },
    created() {
        this.getRoles()
    },
    computed: {
        permissions() {
            return this.$store.state.permissions
        },
    },
    methods: {
        userHasPermission(permissionName) {
            return this.permissions.includes(permissionName);
        },
        async getRoles() {
            await axios.get("/system/get/names-roles")
                .then((response) => {
                    console.log(response)
                    this.roles = response.data.data
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        resetForm() {
            this.form.name = '';
            this.form.last_name = '';
            this.form.email = '';
            this.form.phone = '';
            this.form.password = '';
            this.form.confirmPassword = '';
            this.form.role = '';
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
        async formUpdate() {
            this.showAlertLoading("info", "Updating...", "Please wait...", {
                showConfirmButton: false,
                allowOutsideClick: false,
                willOpen: () => {
                    Swal.showLoading();
                },
            });
            await axios.put(`/system/user/update/${this.user.id}`, {
                name: this.form.name,
                last_name: this.form.last_name,
                email: this.form.email,
                phone: this.form.phone,
                current_password: this.form.current_password,
                password: this.form.password,
                'confirm-password': this.form.confirm_password
            })
                .then((response) => {
                    let message = response.data.message;
                    Swal.close()
                    this.showAlert("success", "Perfect.", message);
                })
                .catch(error => {
                    Swal.close()
                    let errorMessage = error.response.data.message || "Error desconocido";
                    this.showAlert("error", "error.", errorMessage);
                })
        },
      async updatePassword() {
        if (this.form.password !== this.form.confirm_password) {
          this.showAlert("error", "Password mismatch", "The new password and confirmation do not match.");
          return;
        }

        this.showAlertLoading("info", "Updating...", "Please wait...", {
          showConfirmButton: false,
          allowOutsideClick: false,
          willOpen: () => {
            Swal.showLoading();
          },
        });

        await axios.put(`/system/update-password`, {
          current_password: this.form.current_password,
          password: this.form.password,
          password_confirmation: this.form.confirm_password
        })
            .then((response) => {
              let message = response.data.message;
              Swal.close()
              this.showAlert("success", "Perfect.", message);
            })
            .catch(error => {
              Swal.close()
              let errorMessage = error.response.data.message || "Error desconocido";
              this.showAlert("error", "error.", errorMessage);
            });
      },
        async deleteUser() {
            try {
                const result = await Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action will delete your user account.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        container: 'validation__message-container',
                        popup: 'validation__message-popUp',
                        title: 'validation__message-title',
                        content: 'validation__message-content',
                        icon: 'validation__message-icon',
                        confirmButton: 'validation__message-btn',
                        cancelButton: 'validation__message-btn--cancel',
                    },
                });

                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('users', JSON.stringify([this.form.id]));

                    const response = await axios.post(`/system/user/delete`, formData);
                    let message = response.data.message;

                    await Swal.fire({
                        icon: 'success',
                        title: 'Perfect',
                        text: message,
                        confirmButtonText: 'Ok',
                        customClass: {
                            container: 'validation__message-container',
                            popup: 'validation__message-popUp',
                            title: 'validation__message-title',
                            content: 'validation__message-content',
                            icon: 'validation__message-icon',
                            confirmButton: 'validation__message-btn',
                        },
                    });

                    window.location.href = "/";
                }
            } catch (error) {
                let errorMessage = error.response?.data?.message || "Error desconocido";
                await Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    customClass: {
                        container: 'validation__message-container',
                        popup: 'validation__message-popUp',
                        title: 'validation__message-title',
                        content: 'validation__message-content',
                        icon: 'validation__message-icon',
                        confirmButton: 'validation__message-btn',
                    },
                });
            }
        }
    }
}
</script>