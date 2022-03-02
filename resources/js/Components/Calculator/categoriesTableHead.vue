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
          <div class="px-1 w-auto text-left" style="width: 15%">Nom</div>

          <div class="px-1" style="width: 5%">Unité</div>

          <div class="px-1" style="width: 8%">Quantité</div>

          <div class="px-1" style="width: 8%">Rapport</div>

          <div class="px-1" style="width: 8%">Occupation</div>

          <div class="px-1" style="width: 8%">Le prix</div>

          <div class="px-1" style="width: 8%">Total</div>

          <div class="px-1" style="width: 8%">La marge</div>

          <div class="px-1" style="width: 9%">%</div>

          <div class="px-1" style="width: 8%">Coût + Marge</div>
          <div class="px-1" style="width: 16%">
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