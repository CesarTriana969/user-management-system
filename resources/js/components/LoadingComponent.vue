<template>
  <tr>
    <td v-for="n in times" :key="n">
      <div role="status">
        <div class="h-4 bg-gray-200 mt-3 mb-6 rounded"></div>
        <div class="h-4 bg-gray-300 mb-6 rounded"></div>
        <div class="h-4 bg-gray-200 mb-6 rounded"></div>
        <div class="h-4 bg-gray-300 mb-6 rounded"></div>
        <div class="h-4 bg-gray-200 mb-6 rounded"></div>
      </div>
    </td>
  </tr>
</template>

<script>
export default {
  props: {
    times: {
      type: Number,
      default: 5
    }
  }
}
</script>