<template>
  <div class="categoryHead font-medium" v-if="currentGlobalStep == 1">
    <div
      class="flex justify-items-stretch items-stretch mt-2 text-xs uppercase"
    >
      <div
        class="flex items-center py-3 px-4 border uppercase"
        style="min-width: 240px"
      >
        NOM DE CATÉGORIE
      </div>

      <div class="flex flex-col border-b border-r flex-grow">
        <div
          class="
            flex flex-row
            items-center
            text-center
            justify-center
            p-1
            border-t
            h-full
          "
        >
          <div class="px-1 w-auto text-left hidden"></div>
          <div class="px-1 w-auto text-left" style="width: 20%">Nom</div>
          <div class="px-1" style="width: 20%">Standard</div>
          <div class="px-1" style="width: 15%">Actual</div>
          <div class="px-1" style="width: 15%">Gap</div>
          <div class="px-1" style="width: 30%">
            <div class="flex">
              <div class="ml-auto p-1"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["currentGlobalStep"],
};
</script>

<style>
</style>