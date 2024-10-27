<template>
  <label
    class="form__field"
    :class="{ error: error }"
    >{{ label }}
    <input
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :placeholder="placeholder"
      v-bind="$attrs"
      class="input"
    />
    <span v-if="error" class="error-message">{{ error }}</span>
  </label>
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
.error-message {
  color: #3074D3;
  font-size: 12px;
}

.form__field{
  margin: 0;
  width: 100%;
}

.form__field.error__select,
.form__field.error select,
.form__field.field__error,
.form__field.error input{
  border: 1px solid #3074D3;
}
</style>