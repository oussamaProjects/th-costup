<template>
  <div class="map-container relative p-16 min-h-screen">
    <div class="map">
      <img :src="imgSrc" alt="" srcset="" class="h-full" />
    </div>

    <div class="resources pins">
      <div
        v-for="(resource, index) in mainOeuvre"
        :key="resource.id"
        :class="'pin pin-' + index"
      >
        <div style="" v-if="resource.actual > 0">
          <img
            v-if="resource.resource_id == 1"
            :src="img.yellow_helmet"
            alt=""
            :srcset="img.blue_helmet"
          />
          <img
            v-if="resource.resource_id != 1"
            :src="img.blue_helmet"
            alt=""
            :srcset="img.blue_helmet"
          />
          <span class="number">{{ resource.actual }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},

  data() {
    return {
      img: {
        yellow_helmet: "./images/icons/yellow-helmet.png",
        blue_helmet: "./images/icons/blue-helmet.png",
      },
    };
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
  width: 24px;
  border-radius: 50%;
  left: 25%;
  top: 50%;
  position: absolute;
  animation-duration: 1.8s;
  animation-name: clignoter;
  animation-iteration-count: infinite;
  transition: none;
}
.pins .pin.pin-0 {
  animation-duration: 1.82s;
  left: 52%;
  top: 52%;
}

.pins .pin.pin-1 {
  animation-duration: 1.82s;
  left: 50%;
  top: 50%;
}

.pins .pin.pin-2 {
  animation-duration: 1.8s;
  left: 40%;
  top: 30%;
}
.pins .pin.pin-3 {
  animation-duration: 1.81s;
  left: 44%;
  top: 44%;
}
.pins .pin.pin-4 {
  animation-duration: 1.85s;
  left: 20%;
  top: 56%;
}
.pins .pin.pin-5 {
  animation-duration: 1.72s;
  left: 46%;
  top: 46%;
}

.pins .pin.pin-6 {
  animation-duration: 1.72s;
  left: 30%;
  top: 46%;
}

@keyframes clignoter {
  0% {
    opacity: 1;
  }
  40% {
    opacity: 0.25;
  }
  100% {
    opacity: 1;
  }
}
</style>