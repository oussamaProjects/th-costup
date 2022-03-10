<template>
  <div class="map-container relative">
    <div class="map">
      <img :src="imgSrc" alt="" srcset="" />
    </div>

    <div class="resources pins">
      <div
        v-for="resource in mainOeuvre"
        :key="resource.id"
        :class="'pin pin-' + resource.id"
      >
        <div style=""></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},

  data() {
    return {};
  },

  mounted() {},

  props: ["imgSrc", "mainOeuvre"],
};
</script>

<style>
.pins {
  position: absolute;
  left: 30%;
  right: 0;
  top: 0;
  bottom: 20%;
}

.pins .pin {
  height: 14px;
  width: 14px;
  border-radius: 50%;
  right: 50%;
  top: 50%;
  position: absolute;
  animation-duration: 0.8s;
  animation-name: clignoter;
  animation-iteration-count: infinite;
  transition: none;
}
.pins .pin.pin-1 {
  animation-duration: 0.82s;

  background-color: red;
  right: 52%;
  top: 52%;
  width: 18px;
  height: 18px;
}

.pins .pin.pin-2 {
  animation-duration: 0.8s;
  background-color: brown;
  right: 40%;
  top: 40%;
  width: 16px;
  height: 16px;
}
.pins .pin.pin-3 {
  animation-duration: 0.81s;
  background-color: blue;
  right: 44%;
  top: 44%;
  width: 17px;
  height: 17px;
}
.pins .pin.pin-4 {
  animation-duration: 0.85s;
  background-color: green;
  right: 56%;
  top: 56%;
  width: 15px;
  height: 15px;
}
.pins .pin.pin-5 {
  animation-duration: 0.72s;
  background-color: blueviolet;
  right: 46%;
  top: 46%;
  width: 17px;
  height: 17px;
}

@keyframes clignoter {
  0% {
    opacity: 1;
  }
  40% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
</style>