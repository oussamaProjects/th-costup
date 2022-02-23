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

      <!-- Tabs Start -->
      <ul
        class="flex flex-wrap -mb-px"
        id="myTab"
        data-tabs-toggle="#myTabContent"
        role="tablist"
        v-if="this.currentGlobalStep == 1"
      >
        <span :set="(liCatParentIndex = 0)"></span>

        <div v-for="(category, index) in projectData" v-bind:key="index">
          <li
            v-if="liCatParentName != category.parent_name"
            class="mr-2"
            role="presentation"
            :title="category.parent_name"
          >
            <span :set="(liCatParentIndex += 1)"></span>
            <a
              class="
                inline-block
                text-sm
                font-medium
                text-center
                p-3
                uppercase
                border
              "
              :id="'cat_' + liCatParentIndex + '-tab'"
              :data-tabs-target="'cat_' + liCatParentIndex"
              type="button"
              role="tab"
              :aria-controls="'cat_' + liCatParentIndex"
              aria-selected="false"
              @click.prevent="setActive"
              :class="
                isActive('cat_' + liCatParentIndex)
                  ? 'text-white bg-blue-800 hover:text-blue-800 hover:border-blue-800 hover:bg-white'
                  : 'hover:text-blue-800 hover:border-blue-800 hover:bg-white'
              "
              :href="'#cat_' + liCatParentIndex"
            >
              {{ liCatParentIndex }} - {{ category.parent_name }}
            </a>
          </li>
          <span :set="(liCatParentName = category.parent_name)"></span>
        </div>
      </ul>
      <!-- End Tabs -->

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
                        bg-blue-800
                        text-white
                      "
                    >
                      {{ category.parent_name }}
                    </div>

                    <ch-category-table-head
                      :currentGlobalStep="this.currentGlobalStep"
                    ></ch-category-table-head>
                  </div>

                  <ch-add-services
                    :addServices="addServices"
                    :category="category"
                    :globalClass="globalClass"
                    @showListeServices="showListeServicesModal"
                  ></ch-add-services>

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
                      class="bg-gray-200 absolute inset-0 z-50 opacity-50"
                    ></div>

                    <div v-if="enableEditCatId == category.id">
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
                        bg-blue-500
                        text-white
                      "
                      style="min-width: 280px"
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
                            @removeRow="removeServiceRow"
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

            <!-- <ch-categories-step
            :currentstep="currentstep"
            :step="catParentIndex"
            :stepcount="2"
            @step-change="stepChanged"
          >
          </ch-categories-step> -->
          </div>
        </div>
      </div>

      <ch-calculator-results
        :project="this.project"
        :factorsProject="this.factorsProject"
        :factorsNotInProject="this.factorsNotInProject"
        :globalClass="globalClass"
        @refreshProjectResults="initializeProject"
        v-if="currentGlobalStep == 2"
      ></ch-calculator-results>

      <ch-stepper
        :currentGlobalStep="this.currentGlobalStep"
        :step="3"
        @global-step-change="globalStepChanged"
      >
      </ch-stepper>
    </div>

    <jet-dialog-modal
      :show="displayListeServicesModal"
      @close="closeListeServicesModal"
    >
      <template #title>Liste des services </template>

      <template #content>
        <ch-form-services-liste
          :services="selectFromServices"
          :categories="projectData"
          :category="categoryOfSelectFromServices"
          :globalClass="globalClass"
          @addServices="addServices($event)"
        />
      </template>

      <template #footer>
        <jet-secondary-button @click="closeListeServicesModal">
          Cancel
        </jet-secondary-button>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import ChCalculatorResults from "./projectResults.vue";
import ChServicesValuesRow from "./servicesValues.vue";
import ChCategoryValuesRow from "./categoriesValuesSum.vue";
import ChAddServices from "./servicesAdd.vue";
import ChFormServicesListe from "./servicesListe.vue";
import ChCategoriesStep from "./categoriesStep.vue";
import ChStepper from "./stepper.vue";
import ChStepperHead from "./stepperHead.vue";
import ChProjectsList from "./projectsListe.vue";
import ChCategoryTableHead from "./categoriesTableHead.vue";
import ChCircleLoader from "../CircleLoader.vue";

import ChTab from "../Tab.vue";
import ChTabs from "../Tabs.vue";

export default {
  components: {
    JetDialogModal,
    ChCalculatorResults,
    ChServicesValuesRow,
    ChCategoryValuesRow,
    ChAddServices,
    ChFormServicesListe,
    ChCategoriesStep,
    ChStepper,
    ChStepperHead,
    ChProjectsList,
    ChCategoryTableHead,
    ChCircleLoader,
    ChTab,
    ChTabs,
  },
  data() {
    return {
      enableEditCatId: 0,
      project_id: 1,
      factorsProject: null,
      factorsNotInProject: null,
      project: null,
      isLoading: false,
      projectData: null,
      categoryOfSelectFromServices: null,
      selectFromServices: null,
      globalClass: {
        inputSelectForm:
          "appearance-none border border-gray-300 hover:border-gray-300 focus:border-gray-300 w-full p-2 text-gray-700 leading-tight focus:outline-none bg-white hover:bg-blue-100 text-xs transition-all duration-300 transform",
      },
      displayListeServicesModal: false,
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
      this.initializeFactors();
      this.getProjectValues();

      setTimeout(() => {
        this.calculateAll();
      }, 2000);
    },

    changeProject() {
      this.initializeProject();
      this.initializeFactors();
      this.getProjectValues();
    },

    resetServicesValues(serviceNode) {
      var occup_hour = serviceNode.querySelector(".occup_hour").value;
      var price = serviceNode.querySelector(".price").innerHTML;
      var profit_margin_p_c =
        serviceNode.querySelector(".profit_margin_p_c").value;
      var quantity = serviceNode.querySelector(".qty").value;

      var service_id = serviceNode.getAttribute("data-service_id");
      var ratio_metre_hour = serviceNode.querySelector(".ratio_metre_hour");
      var marge = serviceNode.querySelector(".marge");
      var subTotal = serviceNode.querySelector(".subTotal");
      var marge_subTotal = serviceNode.querySelector(".marge_subTotal");

      var subTotalValue = null;
      var ratioMetreHourValue = null;
      var margeValue = null;
      var margeSubTotalValue = null;

      // Parsing
      quantity = parseFloat(quantity);
      occup_hour = parseFloat(occup_hour);
      price = parseFloat(price);
      profit_margin_p_c = parseFloat(profit_margin_p_c);

      // Calculating
      subTotalValue = quantity * price * occup_hour;
      ratioMetreHourValue = quantity / occup_hour;
      margeValue = (subTotalValue * profit_margin_p_c) / 100;
      margeSubTotalValue = subTotalValue + margeValue;

      // Assigning Variables
      ratio_metre_hour.innerHTML = ratioMetreHourValue;
      subTotal.innerHTML = subTotalValue;
      marge.innerHTML = margeValue;
      marge_subTotal.innerHTML = margeSubTotalValue;
    },

    resetCategoriesValues(categoryNode) {
      var _this = this;
      var quantityTotal = 0;
      var occupHourTotal = 0;
      var priceTotal = 0;
      var subTotalTotal = 0;
      var margeTotal = 0;
      var percentMarginTotal = 0;
      var profitMarginTotal = 0;
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
        var occup_hour = serviceNode.querySelector(".occup_hour").value;
        var price = serviceNode.querySelector(".price").innerHTML;
        var subTotal = serviceNode.querySelector(".subTotal").innerHTML;
        var marge = serviceNode.querySelector(".marge").innerHTML;
        var percentMargin =
          serviceNode.querySelector(".profit_margin_p_c").value;
        var profitMargin =
          serviceNode.querySelector(".marge_subTotal").innerHTML;

        // Parsing
        quantity = parseFloat(quantity);
        occup_hour = parseFloat(occup_hour);
        price = parseFloat(price);
        subTotal = parseFloat(subTotal);
        marge = parseFloat(marge);
        percentMargin = parseFloat(percentMargin);
        profitMargin = parseFloat(profitMargin);

        quantityTotal += quantity;
        occupHourTotal += occup_hour;
        priceTotal += price;
        subTotalTotal += subTotal;
        margeTotal += marge;
        percentMarginTotal += percentMargin;
        profitMarginTotal += profitMargin;
      });

      percentMarginTotal = percentMarginTotal / i;
      var category_id = categoryNode.getAttribute("data-category_id");
      var qtyHTML = categorySumValuesNode.querySelector(".qty");
      var occup_hourHTML = categorySumValuesNode.querySelector(".occup_hour");
      var priceHTML = categorySumValuesNode.querySelector(".price");
      var subTotalHTML = categorySumValuesNode.querySelector(".subTotal");
      var margeHTML = categorySumValuesNode.querySelector(".marge");
      var percentMarginHTML =
        categorySumValuesNode.querySelector(".profit_margin_p_c");
      var profitMarginHTML =
        categorySumValuesNode.querySelector(".marge_subTotal");

      // Assigning Variables
      qtyHTML.innerHTML = quantityTotal.toFixed(2);
      occup_hourHTML.innerHTML = occupHourTotal.toFixed(2);
      priceHTML.innerHTML = priceTotal.toFixed(2);
      subTotalHTML.innerHTML = subTotalTotal.toFixed(2);
      margeHTML.innerHTML = margeTotal.toFixed(2);
      percentMarginHTML.innerHTML = percentMarginTotal.toFixed(2);
      profitMarginHTML.innerHTML = profitMarginTotal.toFixed(2);
    },

    addServices(services_id) {
      // Get the selected services from database
      if (services_id != null) this.getSelectedServices(services_id);
      this.displayListeServicesModal = false;
    },

    async getSelectedServices(services_id) {
      await axios.get(`/services/${services_id}/selected`).then((res) => {
        var _this = this;
        var category_id = _this.categoryOfSelectFromServices;
        var categoryNode = null;
        _this.projectData.filter(function (category) {
          if (category.id == category_id) {

            console.log(res.data);
            console.log(category.services);
            category.services = category.services.concat(res.data);
            console.log(category.services);

            categoryNode = document.querySelector(
              "[data-category_id='" + category.id + "']"
            );

            // Re-Calculate the data after the DOM is changed
            setTimeout(() => {
              _this.resetCategoriesValues(categoryNode);
            }, 200);
          } else {
            return false;
          }
        });
      });
    },

    async removeServiceRow(service_id) {
      var _this = this;
      var categoryNode = null;
      var serviceNode = null;

      _this.projectData.filter(function (category) {
        if (category.services != null) {
          category.services = category.services.filter(function (service) {
            return service.id !== service_id;
          });

          var request = {
            project_id: _this.project_id,
            service_id,
          };

          categoryNode = document.querySelector(
            "[data-category_id='" + category.id + "']"
          );

          serviceNode = document.querySelector(
            "[data-service_id='" + service_id + "']"
          );

          if (serviceNode !== null) serviceNode.remove();

          _this.deleteProjectServices(request);
          _this.resetCategoriesValues(categoryNode);
          _this.saveCategoryValues(_this.project_id, categoryNode);
        }
      });
    },

    calculate(event) {
      var _this = this;
      var project_id = this.project_id;
      var categoryNode = event.target.closest(".category");

      _this.resetCategoriesValues(categoryNode);
    },

    showListeServicesModal(category_id) {
      this.displayListeServicesModal = true;
      this.getCategoryServices(category_id);
    },

    closeListeServicesModal() {
      this.displayListeServicesModal = false;
    },

    saveValues(event) {
      var project_id = this.project_id;
      var categoryNode = event.target.closest(".category");

      this.saveServicesValues(project_id, categoryNode);
      this.saveCategoryValues(project_id, categoryNode);
      // this.changeProject();
    },

    enableEditValues(event) {
      this.enableEditCatId = event.target.getAttribute("data-enable-edit");
    },

    saveServicesValues(project_id, categoryNode) {
      var _this = this;
      var _i = 0;

      var servicesRequest = Array();
      var servicesNode = categoryNode.querySelector(".services");
      var servicesValuesNode = servicesNode.querySelector(".services-values");
      var categoryServicesNode =
        servicesValuesNode.querySelectorAll(".service");

      categoryServicesNode.forEach(function (serviceNode) {
        var service_id = serviceNode.querySelector(".service_id").innerHTML;
        var quantity = serviceNode.querySelector(".qty").value;
        var occup_hour = serviceNode.querySelector(".occup_hour").value;
        var price = serviceNode.querySelector(".price").innerHTML;
        var subTotal = serviceNode.querySelector(".subTotal").innerHTML;
        var marge = serviceNode.querySelector(".marge").innerHTML;
        var percentMargin =
          serviceNode.querySelector(".profit_margin_p_c").value;
        var profitMargin =
          serviceNode.querySelector(".marge_subTotal").innerHTML;

        // Parsing
        quantity = parseFloat(quantity);
        occup_hour = parseFloat(occup_hour);
        price = parseFloat(price);
        subTotal = parseFloat(subTotal);
        marge = parseFloat(marge);
        percentMargin = parseFloat(percentMargin);
        profitMargin = parseFloat(profitMargin);

        if (project_id != 0 && project_id != null) {
          if (quantity != null && subTotal != null && profitMargin != null)
            servicesRequest[_i] = {
              project_id: project_id,
              service_id: service_id,
              qty: quantity,
              occup_hour: occup_hour,
              price: price,
              total: subTotal,
              profit_margin_p_c: percentMargin,
              total_plus_margin: profitMargin,
            };
          _i++;
        }
      });

      if (project_id != 0 && project_id != null) {
        _this.storeProjectServices(servicesRequest);
      }
    },

    saveCategoryValues(project_id, categoryNode) {
      var _this = this;
      var quantityTotal = 0;
      var occupHourTotal = 0;
      var priceTotal = 0;
      var subTotalTotal = 0;
      var margeTotal = 0;
      var percentMarginTotal = 0;
      var profitMarginTotal = 0;

      var categorySumValuesNode = categoryNode.querySelector(
        ".category-sum-values"
      );

      var category_id = categoryNode.getAttribute("data-category_id");
      var qtyHTML = categorySumValuesNode.querySelector(".qty").innerHTML;
      var occup_hourHTML =
        categorySumValuesNode.querySelector(".occup_hour").innerHTML;
      var priceHTML = categorySumValuesNode.querySelector(".price").innerHTML;
      var subTotalHTML =
        categorySumValuesNode.querySelector(".subTotal").innerHTML;
      var margeHTML = categorySumValuesNode.querySelector(".marge").innerHTML;
      var percentMarginHTML =
        categorySumValuesNode.querySelector(".profit_margin_p_c").innerHTML;
      var profitMarginHTML =
        categorySumValuesNode.querySelector(".marge_subTotal").innerHTML;

      // Parsing
      quantityTotal = parseFloat(qtyHTML);
      occupHourTotal = parseFloat(occup_hourHTML);
      priceTotal = parseFloat(priceHTML);
      subTotalTotal = parseFloat(subTotalHTML);
      margeTotal = parseFloat(margeHTML);
      percentMarginTotal = parseFloat(percentMarginHTML);
      profitMarginTotal = parseFloat(profitMarginHTML);

      if (project_id != 0 && project_id != null) {
        var request = {
          project_id: project_id,
          category_id: category_id,
          qty: quantityTotal,
          occup_hour: occupHourTotal,
          price: priceTotal,
          total: subTotalTotal,
          profit_margin_p_c: percentMarginTotal,
          total_plus_margin: profitMarginTotal,
        };

        _this.storeProjectCategories(request);
      } else {
        alert("Please select a Project");
      }
    },

    initializeProject() {
      console.log('refreshProjectResults from form');
      var _this = this;
      if (_this.project_id != 0 && _this.project_id != null) {
        axios.get(`/projects/${_this.project_id}`).then((res) => {
          _this.project = res.data;
        });
      }
    },

    initializeFactors() {
      var _this = this;
      if (_this.project_id != 0 && _this.project_id != null) {
        axios.get(`/projects/${_this.project_id}/factors`).then((res) => {
          _this.factorsProject = res.data;
        });

        axios
          .get(`/projects/${_this.project_id}/factorsNotInProject`)
          .then((res) => {
            _this.factorsNotInProject = res.data;
          });
      }
    },

    async storeProjectServices(request) {
      await axios.post("/projects/storeProjectServices", request);
    },

    async deleteProjectServices(request) {
      await axios.post("/projects/deleteProjectServices", request);
    },

    async getCategoryServices(category_id) {
      await axios.get(`/categories/${category_id}/services`).then((res) => {
        var resultArr = this.projectData.filter(function (category) {
          return category.id === category_id;
        });

        let services = resultArr[0].services; 

        var resultArr2 = res.data.filter(function (service) {
          return !services.find(function (obj) {
            return service.id == obj.id;
          });
        }); 

        this.selectFromServices = resultArr2;
        this.categoryOfSelectFromServices = category_id;
      });
    },

    async storeProjectCategories(request) {
      var _this = this;
      _this.isLoading = true;
      await axios
        .post("/projects/storeProjectCategories", request)
        .then(function (response) {
          _this.isLoading = false;
        })
        .catch(function (error) {});
    },

    async getProjectValues() {
      var _this = this;
      if (_this.project_id != 0 && _this.project_id != null) {
        var { data } = await axios.get(`/projects/${_this.project_id}/values`);
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
  props: ["projects", "categories", "globalClass", "factors"],
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

