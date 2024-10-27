<template>
  <button 
    :class="classBtn" 
    :type="type"
  >{{ text }}
    <slot />
  </button>
</template>

<script>
export default {
  name: 'BaseBtn',
  props: {
    type: {
      type: String,
      default: 'button',
    },
    classBtn: {
      type: String,
    },
    text: {
      default: 'Send',
    },
  },
}
</script>
