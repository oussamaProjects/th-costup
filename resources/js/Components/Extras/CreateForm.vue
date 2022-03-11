<template>
  <form @submit.prevent="submit" class="bg-white">
    <div class="flex flex-col -mb-2">
      <div
        v-if="$page.props.flash.failures.form.store.extras"
        class="alert w-full text-xs text-error px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.failures.form.store.extras }}
      </div>

      <div
        v-if="$page.props.flash.success.form.store.extras"
        class="alert w-full text-xs text-success px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.success.form.store.extras }}
      </div>

      <div class="w-full grid grid-cols-2 gap-x-3">
        <div class="w-full">
          <div class="mb-2 uppercase">Coût SMPH</div>
          <div class="mb-2">
            <input
              id="smph_custommer_demand"
              v-model="extras.smph_custommer_demand"
              type="text"
              placeholder="Custommer Demand"
              :class="this.globalClass.inputTextForm"
            />
            <div
              :class="this.globalClass.textError"
              v-if="$page.props.errors.smph_custommer_demand"
            >
              {{ $page.props.errors.smph_custommer_demand }}
            </div>
          </div>

          <div class="mb-2">
            <input
              id="smph_production_available_time"
              v-model="extras.smph_production_available_time"
              type="text"
              placeholder="Production Available Time"
              :class="this.globalClass.inputTextForm"
            />
            <div
              :class="this.globalClass.textError"
              v-if="$page.props.errors.smph_production_available_time"
            >
              {{ $page.props.errors.smph_production_available_time }}
            </div>
          </div>
        </div>

        <div class="w-full">
          <div class="mb-2 uppercase">Coût LMPH</div>
          <div class="mb-2">
            <input
              id="lmph_custommer_demand"
              v-model="extras.lmph_custommer_demand"
              type="text"
              placeholder="Custommer Demand"
              :class="this.globalClass.inputTextForm"
            />
            <div
              :class="this.globalClass.textError"
              v-if="$page.props.errors.lmph_custommer_demand"
            >
              {{ $page.props.errors.lmph_custommer_demand }}
            </div>
          </div>

          <div class="mb-2">
            <input
              id="lmph_production_available_time"
              v-model="extras.lmph_production_available_time"
              type="text"
              placeholder="Production Available Time"
              :class="this.globalClass.inputTextForm"
            />
            <div
              :class="this.globalClass.textError"
              v-if="$page.props.errors.lmph_production_available_time"
            >
              {{ $page.props.errors.lmph_production_available_time }}
            </div>
          </div>
        </div>
      </div>

      <div class="w-full flex flex-col">
        <div class="mb-2 w-44 ml-auto">
          <button
            type="submit"
            :disabled="extras.processing"
            :class="this.globalClass.buttonForm"
          >
            Enregistrer
          </button>
        </div>
      </div>

      <div class="w-full">
        <progress
          v-if="extras.progress"
          :value="extras.progress.percentage"
          max="100"
        >
          {{ extras.progress.percentage }}%
        </progress>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  components: {},

  data() {
    return {
      project_id: this.project_id,
      extras: this.extras,
    };
  },

  props: ["project_id", "extras", "globalClass"],

  mounted() {},

  methods: {
    submit() {
      var _this = this;
      console.log(_this.project_id);
      _this.isLoading = true;

      var request = {
        project_id: _this.project_id,
        extras: _this.extras,
      };

      axios
        .post("/projects/storeProjectExtras", request)
        .then(function (response) {
          _this.isLoading = false;
        })
        .catch(function (error) {});

      _this.extras.smph_custommer_demand = null;
      _this.extras.smph_production_available_time = null;
      _this.extras.lmph_custommer_demand = null;
      _this.extras.lmph_production_available_time = null;
    },
  },
};
</script>

<style>
</style>