<template>
  <article class="h-[420px] w-[400px] max-w-full relative mx-[auto] my-[0] [box-shadow:0px_3px_6px_#00000029] rounded-2xl flex flex-col items-center justify-start mt-[50px] min-[1150px]:mt-0 p-[35px] gap-3 bg-[#FFFFFF] z-10">
    
    <h1 class="text-[#112D55] text-3xl max-md:text-2xl text-center font-bold">Welcome to User Management System!</h1>
    <p class="text-[#112D55] text-base max-md:text-sm mb-3">Please enter your credentials to access your account.</p>
    
    <BaseInput 
      label="" 
      v-model="form.email" 
      type="email" 
      placeholder="Email" 
      autocomplete="email" 
      class="pl-[25px]"
      :error="errors?.email" 
    />
    <div class="relative flex items-center w-full h-fit">
      <BaseInput 
        label="" 
        v-model="form.password" 
        :type="showPassword ? 'text' : 'password'" 
        placeholder="Password"
        autocomplete="current-password" 
        class="pl-[25px]" 
        :error="errors?.password" 
      />
      
      <span 
        class="absolute top-3 right-[15px] cursor-pointer"
        @click="toggleVisibility"
      >
        <BaseIcon 
          v-if="showPassword" 
          iconName="visibility-off" 
          width="22" 
          height="22" 
          iconColor="#112D55" 
          viewBox="61.54 -832.61 836.92 747.38" 
        />
        <BaseIcon 
          v-else 
          iconName="visibility" 
          width="22" 
          height="22" 
          iconColor="#112D55" 
          viewBox="61.54 -780 836.92 560" 
        />
      </span>
    </div>
    <div class="flex flex-col items-center justify-center gap-2 mt-3">
      <BaseBtn 
        @click="send" 
        text="SENDS" 
        class="rounded-3xl px-9 py-2 w-full text-center text-base text-[#fff] bg-[#3074D3] [transition:all_0.5s_ease-out] cursor-pointer relative overflow-hidden" 
      />
    </div>
  </article>
</template>

<script>
import Swal from 'sweetalert2'
import axios from 'axios';
import BaseInput from '../../components/BaseInput.vue';
import BaseBtn from '../../components/BaseBtn.vue';
import BaseIcon from '../../components/BaseIcon.vue';

export default {
  props: {
    show: Boolean,
  },
  components: {
    BaseInput,
    BaseBtn,
    BaseIcon
  },
  data() {
    return {
      errors: {},
      form: {
        email: '',
        password: '',
        remember: '',
      },
      showPassword: false,
    };
  },

  methods: {
    toggleVisibility() {
      this.showPassword = !this.showPassword;
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
    formNotValid() {
      this.errors = {}

      const { remember, ...form } = this.form

      const errorMessages = {
        email: "Email is required",
        password: "Password is required",
      };

      const EMAIL_REGEX = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

      for (const detail in form) {
        !form[detail] && (this.errors[detail] = errorMessages[detail] || `${detail} is required`)
      }

      this.form.email && !EMAIL_REGEX.test(this.form.email) && (this.errors.email = 'Invalid email format');

      return Object.keys(this.errors).length !== 0 ? true : false
    },
    async send() {

      if (this.formNotValid()) {
        this.showAlert("warning", "All fields must be completed.", "Try again!");
        return
      }

      this.showAlertLoading("info", "Sending...", "Please wait...", {
        showConfirmButton: false,
        allowOutsideClick: false,
        willOpen: () => {
          Swal.showLoading();
        },
      });

      axios.post('/login', this.form)
        .then(response => {
          console.log(response);
          Swal.close()
          window.location.reload();
        })
        .catch(error => {
          Swal.close()
          let errorMessage = error.response.data.message || "Unknown error";

          this.showAlert("error", "Error...", errorMessage);
        });

    },
    nextStep() {
      this.$emit('next');
    },
  },
};
</script>
