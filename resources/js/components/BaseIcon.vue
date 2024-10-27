<template>
  <svg 
    xmlns="http://www.w3.org/2000/svg" 
    :fill="iconColor" 
    :stroke="svgStroke" 
    :width="width" 
    :height="height" 
    :viewBox="viewBox"
    :aria-hidden="ariaHidden"
  >
    <path 
      :d="path" 
      :stroke="stroke" 
      :stroke-width="strokeWidth" 
      :stroke-linecap="strokeLinecap" 
      :stroke-linejoin="strokeLinejoin"
      :fill="fillPath"
      :fill-rule="fillRule"
      :clip-rule="clipRule"
    />
  </svg>
</template>

<script>
const icons = {
  'close':'M256-213.85 213.85-256l224-224-224-224L256-746.15l224 224 224-224L746.15-704l-224 224 224 224L704-213.85l-224-224-224 224Z',
}

export default {
  name: 'BaseIcon',
  props: {
    iconName: {
      type: String,
      required: true,
    },
    width: {
      type: [Number, String],
      default: 24,
    },
    height: {
      type: [Number, String],
      default: 24,
    },
    iconColor: {
      type: String,
      default: 'currentColor',
    },
    viewBox: {
      type: String,
      required: true,
    },
    stroke: {
      type: String,
    },
    strokeWidth: {
      type: String,
    },
    strokeLinecap: {
      type: String,
    },
    strokeLinejoin: {
      type: String,
    },
    fillPath: {
      type: String,
    },
    fillRule: {
      type: String,
    },
    clipRule: {
      type: String,
    },
    ariaHidden: {
      type: String,
    },
    svgStroke: {
      type: String,
    },
  },
  computed: {
    path() {
      return icons[this.iconName] || '';
    },
  },
}
</script>

<style scoped>
svg {
  display: block;
}
</style>