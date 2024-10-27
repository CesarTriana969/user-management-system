<template>
  <div v-show="showPopUp" class="pop__up-container">
    <div v-show="showPopUp" class="pop__up-content">

      <BaseIcon 
        @click="close" 
        iconName="close" 
        width="18" 
        height="18" 
        iconColor="#112D55"
        viewBox="213.85 -746.15 532.3 532.3" 
        class="popUp__close" 
      />
      <slot />
    </div>
  </div>
</template>

<script>
import BaseIcon from './BaseIcon.vue';
export default {
  props: ["showPopUp"],
  components: {
    BaseIcon,
  },
  setup(props, { emit }) {
    const close = () => {
      emit("close");
    };
    return { close };
  },
};
</script>

<style scoped>
.pop__up-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  width: 100vw;
  position: fixed;
  top: 0;
  left: 0;
  background-color: #00000050;
  z-index: 80;
}
.pop__up-content {
  position: relative;
  max-width: 80%;
  width: fit-content;
  background: transparent;
  max-width: 1000px;
}
.popUp__close {
  position: absolute;
  top: 20px;
  right: 15px;
  font-size: 40px;
  color: #FFFFFF;
  cursor: pointer;
  z-index: 2;
}

@media (width <=1150px) {
  .pop__up-container {
    align-items: center;
  }
  .pop__up-content {
    position: relative;
    width: fit-content;
    background: transparent;
    max-width: 100%;
    height: fit-content;
    max-height: 95vh;
    padding: 0 25px;
  }
  .popUp__close {
    right: 40px;
    width: 16px;
    height: 16px;
  }
}
</style>