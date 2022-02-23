<template>
  <div class="flex flex-col text-xs">
    <div class="flex justify-items-stretch items-stretch">
      <div
        class="flex items-center p-2 uppercase font-bold bg-blue-500 text-white"
        style="min-width: 280px"
      ></div>

      <div class="flex flex-col border-b border-r flex-grow">
        <div :class="service">
          <div
            class="
              add
              p-2
              cursor-pointer
              uppercase
              font-bold
              text-blue-800
              flex
            "
            @click="showListeServices"
          >
            <div class="ml-auto">
              <!-- <div :class="this.globalClass.link">Ajouté des services</div> -->

              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"
                />
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {
    showListeServices() {
      this.$emit("showListeServices", this.category.id);
    },
  },
  mounted() { 
  },

  props: ["category", "globalClass" ],
};
</script>

<style>
</style>