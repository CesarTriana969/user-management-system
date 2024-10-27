<template>
  <div class="">
    <div class="relative z-0">
      <input
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#3074D3] peer"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :placeholder="placeholder"
        v-bind="$attrs"
      />
      <label
        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-[#3074D3] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
        :class="{ error__label: error }"
      >
        {{ label }}
      </label>
    </div>
    <span v-if="error" class="error__message">{{ error }}</span>
  </div>
</template>

<script>
export default {
  name: 'BaseInput',
  inheritAttrs: false,
  props: {
    label: String,
    placeholder: String,
    modelValue: [String, Number],
    error: String,
  },
}
</script>

<style>
.input__two{
  border:3px solid #D3D3D3;
}
.input__two:not(:placeholder-shown) {
  border-top: 0;
}
.error__message{
  position: relative;
}
.error__label{
  color:var(--second-color)!important;
}
</style>
