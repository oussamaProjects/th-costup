<template>
  <button
    :type="type"
    class="
      inline-flex
      items-center
      px-8
      py-2
      bg-gray-800
      border border-transparent
      rounded-md
      font-semibold
      text-xs text-custom_blue
      uppercase
      tracking-widest
      hover:bg-gray-700
      active:bg-gray-900
      focus:outline-none  
      disabled:opacity-25
      transition
    "
  >
    <slot></slot>
  </button>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    type: {
      type: String,
      default: "submit",
    },
  },
});
</script>
