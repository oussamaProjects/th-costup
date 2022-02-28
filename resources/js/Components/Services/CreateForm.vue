<template>
  <form @submit.prevent="submit" class="bg-white">
    <div class="flex flex-col -mb-2">
     
      <div
        v-if="$page.props.flash.failures.form.store.services"
        class="alert w-full text-xs text-red-600 px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.failures.form.store.services }}
      </div>

      <div
        v-if="$page.props.flash.success.form.store.services"
        class="alert w-full text-xs text-green-600 px-3 py-1 my-2 text-center"
      >
        {{ $page.props.flash.success.form.store.services }}
      </div>

      <div class="w-full grid grid-cols-3 gap-x-3">
        <div class="mb-2">
          <input
            id="name"
            v-model="service.name"
            type="text"
            placeholder="Name"
            :class="this.globalClass.inputTextForm"
          />
          <div :class="this.globalClass.textError" v-if="$page.props.errors.name">{{ $page.props.errors.name }}</div>
        </div>
        <div class="mb-2">
          <input
            id="description"
            v-model="service.description"
            type="text"
            placeholder="Description"
            :class="this.globalClass.inputTextForm"
          /> 
          <div :class="this.globalClass.textError" v-if="$page.props.errors.description">{{ $page.props.errors.description }}</div>

        </div>
        
        <div class="mb-2">
          <select
            id="unit_measure"
            v-model="service.unit_measure"
            :class="this.globalClass.inputTextForm"
          >
            <option disabled selected>Choisir une Unite de meusure</option>
            <option value="--">--</option>
            <option value="0">Heure/m</option>
            <option value="1">Unité</option>
          </select>
          <div :class="this.globalClass.textError" v-if="$page.props.errors.unit_measure">{{ $page.props.errors.unit_measure }}</div>
        </div>

        <div class="mb-2">
          <input
            id="qty"
            v-model="service.qty"
            type="number"
            placeholder="Quantite"
            :class="this.globalClass.inputTextForm"
          /> 
        </div>
        
        <div class="mb-2">
          <input
            id="occup_hour"
            v-model="service.occup_hour"
            type="number"
            placeholder="Occupation hour"
            :class="this.globalClass.inputTextForm"
          /> 
        </div>
        
        <div class="mb-2">
          <input
            id="price"
            v-model="service.price"
            type="number"
            placeholder="Price"
            :class="this.globalClass.inputTextForm"
          />
          <div :class="this.globalClass.textError" v-if="$page.props.errors.price">{{ $page.props.errors.price }}</div>
        </div>
        
        <div class="mb-2">
          <input
            id="profit_margin_p_c"
            v-model="service.profit_margin_p_c"
            type="number"
            placeholder="% Margin"
            :class="this.globalClass.inputTextForm"
            :modelValue="40"
          />
          <div :class="this.globalClass.textError" v-if="$page.props.errors.profit_margin_p_c">{{ $page.props.errors.profit_margin_p_c }}</div>
        </div>

        <div class="mb-2">
          <select
            id="category_id"
            v-model="service.category_id"
            :class="this.globalClass.inputTextForm"
          >
            <option disabled selected>Choisir une catégorie</option>
            <option value="0">--</option>
            <option
              v-for="category in this.categories"
              v-bind:key="category.id"
              :value="category.id"
            >
              {{ category.name }}
            </option>
          </select>
          <div :class="this.globalClass.textError" v-if="$page.props.errors.category_id">{{ $page.props.errors.category_id }}</div>
        </div>
      </div>

      <div class="w-full flex flex-col">
        <div class="mb-2 w-44 ml-auto">
          <button
            type="submit"
            :disabled="service.processing"
            :class="this.globalClass.buttonForm"
          >
            Enregistrer
          </button>
        </div>
      </div>

      <div class="w-full">
        <progress
          v-if="service.progress"
          :value="service.progress.percentage"
          max="100"
        >
          {{ service.progress.percentage }}%
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
      service: {
        name: null,
        description: null,
        unit_measure: null,
        qty: null,
        occup_hour: null,
        price: null,
        profit_margin_p_c: null,
        category_id: null,
      },
    };
  },

  props: ["services", "globalClass", "categories"],

  mounted() {},

  methods: {
    submit() { 
      this.$inertia.post("/services", this.service);
      this.service.id = null;
      this.service.name = null;
      this.service.description = null;
      this.service.unit_measure = null;
      this.service.qty = null;
      this.service.occup_hour = null;
      this.service.price = null;
      this.service.profit_margin_p_c = null;
    },
  },
};
</script>

<style>
</style>