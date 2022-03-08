<template>
  <div class="flex flex-col w-full">
    <div class="p-4">
      <ch-stepper-head
        :currentGlobalStep="this.currentGlobalStep"
      ></ch-stepper-head>

      <ch-projects-list
        :projects="this.projects"
        :currentGlobalStep="this.currentGlobalStep"
        @chooseProjects="chooseProjects"
        :globalClass="globalClass"
      ></ch-projects-list>

      <ch-categories-tab
        :mainCategories="projectData"
        :currentGlobalStep="currentGlobalStep"
        :activeItem="activeItem"
        @setActive="setActive"
      >
      </ch-categories-tab>

      <div id="myTabContent">
        <div
          class="categoryContent relative"
          v-if="this.currentGlobalStep == 1"
        >
          <div
            class="
              flex flex-col
              justify-items-stretch
              items-stretch
              text-xs
              tabs
              relative
            "
          >
            <div :set="(catParentIndex = 0)"></div>

            <div
              v-for="(category, index) in projectData"
              v-bind:key="index"
              class="cats"
            >
              <div v-if="catParentName != category.parent_name">
                <div :set="(catParentIndex += 1)"></div>
              </div>

              <div
                :set="(catParentName = category.parent_name)"
                :class="'cat_' + catParentIndex"
              ></div>

              <div
                :id="'cat_' + catParentIndex"
                class=""
                role="tabpanel"
                :aria-labelledby="'cat_' + catParentIndex + '-tab'"
                :class="{ hidden: !isActive('cat_' + catParentIndex) }"
              >
                <div
                  :data-category_id="category.id"
                  :data-category_parent_id="category.parent_id"
                  :data-category_parent_name="category.parent_name"
                  class="flex flex-col w-full"
                  :class="'category mb-1 category_' + category.id"
                >
                  <div>
                    <div
                      v-if="catParentName != category.parent_name"
                      class="
                        p-3
                        text-center
                        uppercase
                        font-bold
                        text-bg
                        bg-main
                        text-custom_blue
                      "
                    >
                      {{ category.parent_name }}
                    </div>

                    <ch-category-table-head
                      :currentGlobalStep="this.currentGlobalStep"
                    ></ch-category-table-head>
                  </div>

                  <div
                    class="
                      flex
                      justify-items-stretch
                      items-stretch
                      services
                      relative
                    "
                  >
                    <div
                      v-if="enableEditCatId != category.id"
                      class="bg-gray-200 absolute inset-0 z-50 opacity-25"
                    ></div>

                    <div v-if="enableEditCatId == category.id && isLoading">
                      <ChCircleLoader
                        v-if="isLoading"
                        :color="'#3b82f6'"
                      ></ChCircleLoader>
                    </div>

                    <div
                      class="
                        flex
                        items-center
                        p-2
                        uppercase
                        font-bold
                        bg-main
                        text-custom_blue
                      "
                      style="min-width: 240px"
                    >
                      {{ category.name }}
                    </div>

                    <div
                      class="
                        flex flex-col
                        border-b border-r
                        flex-grow
                        services-values
                      "
                    >
                      <transition-group name="list" tag="p">
                        <div
                          v-for="service in category.services"
                          v-bind:key="service.id"
                          :class="'service service_' + service.id"
                          :data-service_id="service.id"
                        >
                          <ch-services-values-row
                            :service="service"
                            @calculateValues="calculate"
                            :globalClass="this.globalClass"
                          ></ch-services-values-row>
                        </div>
                      </transition-group>
                    </div>
                  </div>

                  <ch-category-values-row
                    :category="category"
                    :isLoading="isLoading"
                    @getCategorySumValues="saveValues"
                    @getCategoryEditValues="enableEditValues"
                  ></ch-category-values-row>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="categoryContent relative" v-if="this.currentGlobalStep == 2">
        <div class="max-full mt-4 flex">
          <a
            :href="'/pdf-sag/' + this.project.id"
            target="_blank"
            :class="
              'bg-main ml-auto w-44 text-center ' + globalClass.buttonForm
            "
            rel="noopener noreferrer"
            >Standard Actual Gap</a
          >
        </div>
      </div>

      <ch-stepper
        :currentGlobalStep="this.currentGlobalStep"
        :step="3"
        @global-step-change="globalStepChanged"
      >
      </ch-stepper>
    </div>
  </div>
</template>

<script>
import ChCategoriesStep from "./categoriesStep.vue";
import ChCategoryTableHead from "./categoriesTableHead.vue";
import ChCategoryValuesRow from "./categoriesValuesSum.vue";
import ChProjectsList from "./projectsList.vue";
import ChServicesValuesRow from "./servicesValues.vue";
import ChStepper from "./stepper.vue";
import ChStepperHead from "./stepperHead.vue";
import ChCircleLoader from "../CircleLoader.vue";

import ChCategoriesTab from "../categoriesTab.vue";
import ChTab from "../Tab.vue";
import ChTabs from "../Tabs.vue";

export default {
  components: {
    ChCategoriesStep,
    ChCategoriesTab,
    ChCategoryTableHead,
    ChCategoryValuesRow,
    ChProjectsList,
    ChServicesValuesRow,
    ChStepper,
    ChStepperHead,
    ChCircleLoader,
    ChTab,
    ChTabs,
  },
  data() {
    return {
      enableEditCatId: 0,
      project_id: 1,
      project: null,
      isLoading: false,
      projectData: null,
      selectFromServices: null,
      globalClass: {
        inputSelectForm:
          "appearance-none border border-gray-300 hover:border-gray-300 focus:border-gray-300 w-full p-2 text-gray-700 leading-tight focus:outline-none bg-white hover:bg-main text-xs transition-all duration-300 transform",
      },
      currentstep: 0,
      currentGlobalStep: 0,
      activeItem: "cat_1",
    };
  },
  methods: {
    isActive(menuItem) {
      return this.activeItem === menuItem;
    },

    setActive(event) {
      this.activeItem = event.target.getAttribute("data-tabs-target");
    },

    chooseProjects(project_id) {
      this.currentGlobalStep = 1;
      this.project_id = project_id;

      this.initializeProject();
      this.getProjectSAG();

      setTimeout(() => {
        this.calculateAll();
      }, 2000);
    },

    changeProject() {
      this.initializeProject();
      this.getProjectSAG();
    },

    resetServicesValues(serviceNode) {
      var service_id = serviceNode.getAttribute("data-service_id");
      var quantity = serviceNode.querySelector(".qty").value;
      var actual = serviceNode.querySelector(".actual").value;
      var gap = serviceNode.querySelector(".gap");

      var actualValue = null;
      var gapValue = null;

      // Parsing
      quantity = parseInt(quantity);
      actual = parseInt(actual);

      // Calculating
      gapValue = quantity - actual;

      // Assigning Variables
      gap.innerHTML = gapValue || 0;
    },
    resetCategoriesValues(categoryNode) {
      var _this = this;
      var quantityTotal = 0;
      var actualTotal = 0;
      var gapTotal = 0;
      var i = 0;

      var categorySumValuesNode = categoryNode.querySelector(
        ".category-sum-values"
      );

      var servicesNode = categoryNode.querySelector(".services");
      var servicesValuesNode = servicesNode.querySelector(".services-values");
      var categoryServicesNode =
        servicesValuesNode.querySelectorAll(".service");

      categoryServicesNode.forEach(function (serviceNode) {
        _this.resetServicesValues(serviceNode);
        i++;
        var service_id = serviceNode.getAttribute("data-service_id");
        var quantity = serviceNode.querySelector(".qty").value;
        var actual = serviceNode.querySelector(".actual").value;
        var gap = serviceNode.querySelector(".gap").innerHTML;

        // Parsing
        quantity = parseInt(quantity);
        actual = parseInt(actual);
        gap = parseInt(gap);

        quantityTotal += quantity;
        actualTotal += actual;
        gapTotal += gap;
      });

      var category_id = categoryNode.getAttribute("data-category_id");
      var qtyHTML = categorySumValuesNode.querySelector(".qty");
      var actualHTML = categorySumValuesNode.querySelector(".actual");
      var gapHTML = categorySumValuesNode.querySelector(".gap");

      // Assigning Variables
      qtyHTML.innerHTML = quantityTotal || 0;
      actualHTML.innerHTML = actualTotal || 0;
      gapHTML.innerHTML = gapTotal || 0;
    },

    calculate(event) {
      var _this = this;
      var project_id = this.project_id;
      var categoryNode = event.target.closest(".category");

      _this.resetCategoriesValues(categoryNode);
    },

    enableEditValues(event) {
      this.enableEditCatId = event.target.getAttribute("data-enable-edit");
    },

    initializeProject() {
      var _this = this;
      if (_this.project_id != 0 && _this.project_id != null) {
        axios.get(`/projects/${_this.project_id}`).then((res) => {
          _this.project = res.data;
        });
      }
    },

    saveValues(event) {
      var project_id = this.project_id;
      var categoryNode = event.target.closest(".category");

      this.saveServicesSAG(project_id, categoryNode);
      this.saveCategorySAG(project_id, categoryNode);
      this.changeProject();
    },

    saveServicesSAG(project_id, categoryNode) {
      var _this = this;
      var _i = 0;

      var servicesRequest = Array();
      var servicesNode = categoryNode.querySelector(".services");
      var servicesValuesNode = servicesNode.querySelector(".services-values");
      var categoryServicesNode =
        servicesValuesNode.querySelectorAll(".service");

      categoryServicesNode.forEach(function (serviceNode) {
        var service_id = serviceNode.querySelector(".service_id").innerHTML;
        var qty = serviceNode.querySelector(".qty").value;
        var actual = serviceNode.querySelector(".actual").value;
        var gap = serviceNode.querySelector(".gap").innerHTML;

        // Parsing
        qty = parseInt(qty);
        actual = parseInt(actual);
        gap = parseInt(gap);

        if (project_id != 0 && project_id != null) {
          if (qty != null && actual != null && gap != null)
            servicesRequest[_i] = {
              project_id,
              service_id,
              qty,
              actual,
              gap,
            };
          _i++;
        }
      });

      if (project_id != 0 && project_id != null) {
        _this.storeSAGProjectServices(servicesRequest);
      }
    },

    saveCategorySAG(project_id, categoryNode) {
      var _this = this;
      var quantityTotal = 0;
      var actualTotal = 0;
      var gapTotal = 0;

      var categorySumValuesNode = categoryNode.querySelector(
        ".category-sum-values"
      );

      var category_id = categoryNode.getAttribute("data-category_id");
      var qtyHTML = categorySumValuesNode.querySelector(".qty").innerHTML;
      var actualHTML = categorySumValuesNode.querySelector(".actual").innerHTML;
      var gapHTML = categorySumValuesNode.querySelector(".gap").innerHTML;

      // Parsing
      quantityTotal = parseInt(qtyHTML);
      actualTotal = parseInt(actualHTML);
      gapTotal = parseInt(gapHTML);

      if (project_id != 0 && project_id != null) {
        var request = {
          project_id: project_id,
          category_id: category_id,
          qty: quantityTotal,
          actual: actualTotal,
          gap: gapTotal,
        };

        _this.storeSAGProjectCategories(request);
      } else {
        alert("Please select a Project");
      }
    },

    async storeSAGProjectServices(request) {
      await axios.post("/sag/storeSAGProjectServices", request);
    },

    async storeSAGProjectCategories(request) {
      var _this = this;
      _this.isLoading = true;
      await axios
        .post("/sag/storeSAGProjectCategories", request)
        .then(function (response) {
          _this.isLoading = false;
          _this.enableEditCatId = 0;
        })
        .catch(function (error) {});
    },

    async getProjectSAG() {
      var _this = this;
      if (_this.project_id != 0 && _this.project_id != null) {
        var { data } = await axios.get(`/projects/${_this.project_id}/preSAG`);
        _this.projectData = data;
      } else _this.projectData = _this.categories;
    },

    stepChanged(step) {
      this.currentstep = step;
    },

    globalStepChanged(step) {
      this.currentGlobalStep = step;
      if (this.currentGlobalStep == 1)
        setTimeout(() => {
          this.calculateAll();
        }, 500);
      if (this.currentGlobalStep == 2) this.initializeProject();
    },

    calculateAll() {
      var categoryNode = null;
      var _this = this;

      _this.projectData.filter(function (category) {
        categoryNode = document.querySelector(
          "[data-category_id='" + category.id + "']"
        );
        _this.resetCategoriesValues(categoryNode);
      });
    },
  },
  async mounted() {},
  computed: {},
  props: ["projects", "categories", "globalClass"],
};
</script>

<style>
.list-item {
  display: inline-block;
  margin-right: 10px;
}
.list-enter-active,
.list-leave-active {
  transition: all 1s;
}
.list-enter, .list-leave-to /* .list-leave-active below version 2.1.8 */ {
  opacity: 0;
  transform: translateX(30px);
}
</style>

