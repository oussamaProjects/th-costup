<template>
  <div class="bg-gray-200 absolute loader inset-0 z-50 opacity-50 flex items-center justify-center">
    <div
      v-show="loading"
      class="lds-circle"
      v-bind:style="[spinnerStyle]"
    ></div>
  </div>
</template>

<script>
// import validateDuration from "../helpers/validateDuration.js";
export default {
  name: "CircleLoader",
  props: {
    loading: {
      type: Boolean,
      default: true,
    },
    color: {
      type: String,
      default: "#7f58af",
    },
    size: {
      type: Number,
      default: 20,
    },
    duration: {
      type: String,
      default: "2.4s",
      // validator: validateDuration,
    },
  },
  data() {
    return {
      spinnerStyle: {
        background: this.color,
        width: `${this.size}px`,
        height: `${this.size}px`,
        animationDuration: this.duration,
      },
    };
  },
};
</script>

<style scoped>
.lds-circle {
  display: inline-block;
  margin: 8px;
  border-radius: 50%;
  animation-name: lds-circle;
  animation-timing-function: cubic-bezier(0, 0.2, 0.8, 1);
  animation-iteration-count: infinite;
}
@keyframes lds-circle {
  0%,
  100% {
    animation-timing-function: cubic-bezier(0.5, 0, 1, 0.5);
  }
  0% {
    transform: rotateY(0deg);
  }
  50% {
    transform: rotateY(1800deg);
    animation-timing-function: cubic-bezier(0, 0.5, 0.5, 1);
  }
  100% {
    transform: rotateY(3600deg);
  }
}
</style>