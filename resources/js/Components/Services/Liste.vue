<template>
  <div
    v-if="$page.props.flash.failures.list.services"
    class="alert w-full text-red-600 px-3 py-1 my-2 text-center"
  >
    {{ $page.props.flash.failures.list.services }}
  </div>

  <div
    v-if="$page.props.flash.success.list.services"
    class="alert w-full text-green-600 px-3 py-1 my-2 text-center"
  >
    {{ $page.props.flash.success.list.services }}
  </div>

  <table class="table-fixe w-full text-sm">
    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
      <tr>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">Nom</div>
        </th> 
        <!-- <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">Description</div>
        </th> -->
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">unit</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">qty</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">occup_hour</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">price</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">%</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">Category</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left text-center">Actions</div>
        </th>
      </tr>
    </thead>
    <tbody class="text-xs m divide-y divide-gray-100">
      <tr v-for="service in services" v-bind:key="service.id">
        <td class="p-1 whitespace-wrap">{{ service.name }}</td>
        <!-- <td class="p-1 whitespace-wrap">{{ service.description }}</td> -->
        <td class="p-1 whitespace-wrap">{{ service.unit_measure }}</td>
        <td class="p-1 whitespace-wrap">{{ service.qty }}</td>
        <td class="p-1 whitespace-wrap">{{ service.occup_hour }}</td>
        <td class="p-1 whitespace-wrap">{{ service.price }}</td>
        <td class="p-1 whitespace-wrap">{{ service.profit_margin_p_c }}</td>
        <td class="p-1 whitespace-wrap">{{ service.category_name }}</td>

        <td class="p-1 whitespace-wrap flex items-center justify-center">
          <a href="#" @click="showUpdateServicesModal(service.id)">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="text-green-800 h-3 w-3"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
              />
            </svg>
          </a>
          <a href="#" @click="deleteService(service.id)">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="ml-2 text-red-600 h-3 w-3"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
              />
            </svg>
          </a>
        </td>
      </tr>
    </tbody>
  </table>

  <!-- <ch-pagination class="mt-6" :links="services.links" /> -->

  <ch-update-modal
    :showUpdateModal="displayUpdateServicesModal"
    :services="services"
    :categories="categories"
    :service="service"
    @closeModal="closeUpdateModal"
    :globalClass="this.globalClass"
  ></ch-update-modal>
</template>

<script>
import ChUpdateModal from "./UpdateModal.vue";
import ChPagination from "../Pagination.vue";

export default {
  components: {
    ChUpdateModal,
    ChPagination,
  },

  data() {
    return {
      service: this.service,
      displayUpdateServicesModal: false,
    };
  },

  props: [
    "services",
    "formattedServices",
    "service",
    "globalClass",
    "categories",
  ],

  mounted() {},

  methods: {
    showUpdateServicesModal(id) {
      axios.get(`/services/${id}`).then((res) => {
        this.service.id = res.data.id;
        this.service.name = res.data.name;
        this.service.description = res.data.description;
        this.service.unit_measure = res.data.unit_measure;
        this.service.qty = res.data.qty;
        this.service.occup_hour = res.data.occup_hour;
        this.service.price = res.data.price;
        this.service.profit_margin_p_c = res.data.profit_margin_p_c;
        this.service.category_id = res.data.category_id;
      });
      this.displayUpdateServicesModal = true;
    },

    deleteService(id) {
      this.$inertia.delete(`/services/${id}`);
    },

    closeUpdateModal() {
      this.service = {
        naem: null,
        description: null,
        unit_measure: null,
        qty: null,
        occup_hour: null,
        price: null,
        profit_margin_p_c: null, 
        category_id: null,
      };
      this.displayUpdateServicesModal = false;
    },
  },
};
</script>

<style>
</style>