<template>
  <div class="map-container relative w-full">
    <div class="map">
      <img :src="imgSrc" alt="" srcset="" class="w-full"/>
    </div>

    <div class="resources pins">
      <div
        v-for="(resource, index) in mainOeuvre"
        :key="resource.id"
        :class="'pin pin-' + index"
      >
        <div style="">{{ resource.actual }}</div>
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
  left: 0%;
  right: 0;
  top: 0;
  bottom: 20%;
  font-size: 10px;
  color: #ffffff;
}

.pins .pin {
  height: 14px;
  width: 14px;
  border-radius: 50%;
  left: 25%;
  top: 50%;
  position: absolute;
  animation-duration: 0.8s;
  animation-name: clignoter;
  animation-iteration-count: infinite;
  transition: none;
}
.pins .pin.pin-0 {
  animation-duration: 0.82s;
  background-color: brown;
  left: 52%;
  top: 52%; 
}

.pins .pin.pin-1 {
  animation-duration: 0.82s;
  background-color: red;
  left: 52%;
  top: 52%; 
}

.pins .pin.pin-2 {
  animation-duration: 0.8s;
  background-color: brown;
  left: 40%;
  top: 30%; 
}
.pins .pin.pin-3 {
  animation-duration: 0.81s;
  background-color: blue;
  left: 44%;
  top: 44%; 
}
.pins .pin.pin-4 {
  animation-duration: 0.85s;
  background-color: green;
  left: 20%;
  top: 56%;
}
.pins .pin.pin-5 {
  animation-duration: 0.72s;
  background-color: blueviolet;
  left: 46%;
  top: 46%; 
}

.pins .pin.pin-6 {
  animation-duration: 0.72s;
  background-color: coral;
  left: 30%;
  top: 46%; 
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