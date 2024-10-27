<template>
  
  <button 
    class="btn" 
    :type="type">{{ text }}
    <slot />
  </button>

</template>

<script>
export default {
  name: 'btnItem',
  props: {
    type: {
      type: String,
      default: 'button',
    },
    text: {
      default: 'Ver Producto',
    },
  },
}
</script>
