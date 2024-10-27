<template>
  <tbody class="bg-white divide-y divide-gray-200">
    <tr>
      <td class="w-full text-center mx-auto pt-6 pb-10" :colspan="cols">
        <img class="w-32 h-32 mx-auto"
          src="https://res.cloudinary.com/daqsjyrgg/image/upload/v1690261234/di7tvpnzsesyo7vvsrq4.svg"
          alt="image empty states">
        <p class="text-gray-700 font-medium text-lg text-center">No {{ info }} data available.</p>
        <p class="text-gray-500 text-center">You can add new {{ info }} data to display in this table.</p>
      </td>
    </tr>
  </tbody>
</template>

<script>
export default {
  props: {
    info: {
      type: Text
    },
    cols: {
      type: Number
    }
  },
}
</script>