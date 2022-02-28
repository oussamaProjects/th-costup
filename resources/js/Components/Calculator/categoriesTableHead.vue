<template>
  
        <div class="categoryHead" v-if="currentGlobalStep == 1">
          <div class="flex justify-items-stretch items-stretch mt-2 text-xs">
            <div
              class="flex items-center py-2 px-4 border uppercase"
              style="min-width: 280px"
            >
              Category name
            </div>

            <div class="flex flex-col border-b border-r flex-grow">
              <div
                class="
                  flex flex-row
                  items-center
                  justify-items-stretch
                  p-1
                  border-t
                "
              >
                <div class="px-1 w-auto" style="width: 15%">name</div>

                <div class="px-1" style="width: 5%">unit</div>

                <div class="px-1" style="width: 8%">qty</div>

                <div class="px-1" style="width: 8%">Ratio</div>

                <div class="px-1" style="width: 8%">occupy</div>

                <div class="px-1" style="width: 8%">price</div>

                <div class="px-1" style="width: 8%">Total</div>

                <div class="px-1" style="width: 8%">Marge</div>

                <div class="px-1" style="width: 9%">%</div>

                <div class="px-1" style="width: 8%">Coût+Marge</div>
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
props:['currentGlobalStep']
}
</script>

<style>

</style>