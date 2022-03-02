<template>
  <ChCircleLoader v-if="this.isLoading" :color="'#3b82f6'"></ChCircleLoader>

  <div class="flex flex-col w-full">
    <ch-factor-values
      v-for="(factor, index) in availableFactorsProject"
      v-bind:key="index"
      :factor="factor"
      :globalClass="globalClass"
      @removeFactorRow="removeFactor"
    ></ch-factor-values>

    <div class="flex flex-row items-center justify-items-stretch p-1 border-t text-sm">
      <div class="px-1 w-auto hidden factor_id" style="width: 15%">--</div>
      <div class="px-1 w-auto" style="width: 24%">--</div>
      <div class="px-1" style="width: 20%">--</div>
      <!-- <div class="px-1" style="width: 8%">--</div> -->
      <div class="px-1 ml-auto" style="width: 16%">
        <select
          name="factorSelect"
          id="factorSelect"
          @change="addFactor"
          :class="globalClass.inputTextForm"
          v-model="key"
        >
          <option value="0" selected>Choisir un Factor</option>
          <option
            v-for="(factor, index) in selectFactors"
            v-bind:key="index"
            :value="factor"
          >
            {{ factor.name }}
          </option>
        </select>
      </div>
    </div>

    <div class="flex flex-row items-center justify-items-stretch p-1 border-t">
      <div class="px-1 w-auto hidden factor_id" style="width: 15%"> </div>
      <div class="px-1 w-auto" style="width: 24%"> </div>
      <div class="px-1" style="width: 20%"> </div>
      <!-- <div class="px-1" style="width: 8%">--</div> -->
      <div class="px-1 ml-auto" style="width: 16%">
        <button
          value="save"
          name="save"
          :class="globalClass.buttonForm"
          @click="saveFactorValues"
        >
          Calculate
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import ChFactorValues from "../Factors/FactorValues.vue";
import ChCircleLoader from "../CircleLoader.vue";

export default {
  components: {
    ChFactorValues,
    ChCircleLoader,
  },
  data() {
    return {
      key: "",
      isLoading: false,
      globalClass: {
        inputSelectForm:
          "appearance-none border border-gray-300 hover:border-gray-300 focus:border-gray-300 w-full p-2 text-gray-700 leading-tight focus:outline-none bg-white hover:bg-main text-xs transition-all duration-300 transform",
        inputTextForm:
          "appearance-none border-0 hover:border-gray-300 focus:border-gray-300 rounded-sm w-full p-1 text-gray-700 leading-tight focus:outline-none bg-white hover:bg-main text-xs transition-all duration-300 transform",
      },
      availableFactorsProject: this.factorsProject,
      selectFactors: this.factorsNotInProject,
    };
  },
  mounted() {},
  methods: {
    removeFactor(key) {
      var _this = this;

      var afp = _this.availableFactorsProject;
      var sf = _this.selectFactors;

      console.log(key);
      sf.push(key);

      afp = afp.filter((item) => item.id != key.id);

      _this.availableFactorsProject = afp;
      _this.selectFactors = sf;

      _this.$emit("removeFactorToForm", key);
    },
    addFactor(event) {
      var _this = this;
      if (_this.key != 0) {
        var sf = _this.selectFactors;
        var afp = _this.availableFactorsProject;

        afp.push(_this.key);
        sf = sf.filter((item) => item.id != _this.key.id);

        _this.availableFactorsProject = afp;
        _this.selectFactors = sf;
      }

      _this.$emit("addFactorToForm", event);
    },

    saveFactorValues(project_id) {
      var factorsRequest = Array();
      var factorTotal = 0;
      var factorsPercent = 0;
      var _i = 0;
      var _this = this;
      console.log(_this.project_id);
      _this.availableFactorsProject.forEach(function (factor) {
        factorTotal += factor.value;
        if (_this.project_id != 0 && _this.project_id != null) {
          factorsRequest[_i] = {
            project_id: _this.project_id,
            factor_id: factor.id,
            value: factor.value,
          };
          _i++;
        }
      });

      if (project_id != 0 && project_id != null) {
        _this.storeProjectFactors(factorsRequest);
      }

      factorsPercent = factorTotal / this.availableFactorsProject.length;

      _this.$emit("refreshProjectValues", _this.isLoading);
    },
    async storeProjectFactors(request) {
      var _this = this;
      _this.isLoading = true;
      await axios
        .post("/projects/storeProjectFactors", request)
        .then(function (response) {
          _this.isLoading = false;
        })
        .catch(function (error) {});
    },
  },
  computed: {},
  props: ["project_id", "factorsNotInProject", "factorsProject", "globalClass"],
};
</script>

<style>
</style>