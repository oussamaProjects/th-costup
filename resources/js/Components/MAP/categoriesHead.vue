<template>
  <div class="categoryHead bg-gray-100 shadow-sm px-2 font-semibold">
    <div
      class="flex justify-items-stretch items-stretch resources relative w-full"
    >
      <div class="flex items-center justify-start" style="min-width: 120px">
        CATÉGORIE
      </div>

      <div class="w-full">
        <div>
          <div
            class="
              flex flex-row
              items-center
              text-center
              justify-stretch
              p-1
              border-t
            "
          >
            <div class="px-1 w-auto text-left hidden"></div>
            <div class="px-1 w-auto text-left" style="width: 70%">Nom</div>
            <div class="px-1" style="width: 10%">S</div>
            <div class="px-1" style="width: 10%">A</div>
            <div class="px-1" style="width: 10%">G</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.categoryHead {
  font-size: 10px !important;
}
</style>