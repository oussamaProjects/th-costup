<template>
  <div
    v-if="$page.props.flash.failures.list.factors"
    class="alert w-full text-xs text-error px-3 py-1 my-2 text-center"
  >
    {{ $page.props.flash.failures.list.factors }}
  </div>

  <div
    v-if="$page.props.flash.success.list.factors"
    class="alert w-full text-xs text-success px-3 py-1 my-2 text-center"
  >
    {{ $page.props.flash.success.list.factors }}
  </div>

  <table class="table-fixe w-full text-sm">
    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
      <tr>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">Nom</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">value</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">type</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left text-center">Actions</div>
        </th>
      </tr>
    </thead>
    <tbody class="text-xs m divide-y divide-gray-100">
      <tr v-for="factor in this.factors" v-bind:key="factor.id">
        <td class="p-1 whitespace-wrap">{{ factor.name }}</td>
        <td class="p-1 whitespace-wrap">{{ factor.value }}</td>
        <td class="p-1 whitespace-wrap">{{ factor.type }}</td>

        <td class="p-1 whitespace-wrap flex items-center justify-center">
          <a href="#" @click="showUpdateFactorsModal(factor.id)">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="text-success h-3 w-3"
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
          <a href="#" @click="deleteCategory(factor.id)">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="ml-2 text-error h-3 w-3"
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

  <ch-update-modal
    :showUpdateModal="displayUpdateFactorsModal"
    :factors="factors"
    :factor="factor"
    @closeModal="closeUpdateModal"
    :globalClass="this.globalClass"
  ></ch-update-modal>
</template>

<script>
import ChUpdateModal from "./UpdateModal.vue";

export default {
  components: {
    ChUpdateModal,
  },

  data() {
    return {
      factor: this.factor,
      displayUpdateFactorsModal: false,
    };
  },

  props: ["factors", "factor", "globalClass"],

  mounted() {},

  methods: {
    showUpdateFactorsModal(id) {
      axios.get(`/factors/${id}`).then((res) => {
        this.factor.id = res.data.id;
        this.factor.name = res.data.name;
        this.factor.value = res.data.value;
        this.factor.type = res.data.type;
      });

      this.displayUpdateFactorsModal = true;
    },

    deleteCategory(id) {
      this.$inertia.delete(`/factors/${id}`);
    },

    closeUpdateModal() {
      this.factor = {
        name: null,
        value: null,
        type: null,
      };
      this.displayUpdateFactorsModal = false;
    },
  },
};
</script>

<style>
</style>