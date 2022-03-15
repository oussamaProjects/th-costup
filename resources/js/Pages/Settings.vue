<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Calculator
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col bg-white overflow-hidden shadow-lg sm:rounded">
          <ch-project-component
            :projects="this.projects" 
            :globalClass="globalClass"
          />

          <ch-category-component
            :categories="this.categories"
            :formattedCategories="this.formattedCategories"
            :ChildCategories="this.ChildCategories"
            :globalClass="globalClass"
          />

          <ch-service-component
            :services="this.services"
            :ChildCategories="this.ChildCategories"
            :globalClass="globalClass"
          />
          
          <ch-factor-component
            :factors="this.factors" 
            :globalClass="globalClass"
          />

          <ch-history-statue-component
            :history_statues="this.history_statues" 
            :ChildCategories="this.ChildCategories" 
            :globalClass="globalClass"
          />

            <!-- :formattedServices="this.formattedServices" -->
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import ChProjectComponent from "../Components/Projects/Component.vue";
import ChCategoryComponent from "../Components/Categories/Component.vue";
import ChServiceComponent from "../Components/Services/Component.vue";
import ChCalculatorForm from "../Components/Calculator/Form.vue";
import ChFactorComponent from "../Components/Factors/Component.vue";
import ChHistoryStatueComponent from "../Components/HistoryStatue/Component.vue";

export default defineComponent({
  components: {
    AppLayout,
    ChServiceComponent,
    ChCategoryComponent,
    ChProjectComponent,
    ChFactorComponent,
    ChCalculatorForm,
    ChHistoryStatueComponent,
  },

  data() {
    return {
      globalClass: {
        inputTextForm: "appearance-none border border-gray-400 hover:border-gray-300 rounded-sm w-full p-2 text-gray-700 leading-tight focus:outline-none shadow bg-white hover:bg-main text-xs transition-all duration-300 transform",
        buttonForm: "appearance-none border border-main hover:border-main rounded-sm w-full p-2 text-custom_blue leading-tight focus:outline-none shadow bg-white hover:bg-main text-xs transition-all duration-300 transform",
        link: "text-xs text-custom_blue hover:text-custom_blue transition-all duration-300 transform cursor-pointer",
        textError: "text-error text-xs bg-error p-1 rounded-xs mt-1",
        textSucces: "text-custom_blue text-xs bg-success p-1 rounded-xs mt-1",
      },
    };
  },

  mounted() {
  },

  props: [ 
    "projects",
    "categories",
    "formattedCategories",
    "services",
    "factors",
    // "formattedServices",
    "ChildCategories",
    "history_statues",
  ],
});
</script>
