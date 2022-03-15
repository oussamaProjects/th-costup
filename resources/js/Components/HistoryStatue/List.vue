<template>
  <div
    v-if="$page.props.flash.failures.list.history_statues"
    class="alert w-full text-xs text-error px-3 py-1 my-2 text-center"
  >
    {{ $page.props.flash.failures.list.history_statues }}
  </div>

  <div
    v-if="$page.props.flash.success.list.history_statues"
    class="alert w-full text-xs text-success px-3 py-1 my-2 text-center"
  >
    {{ $page.props.flash.success.list.history_statues }}
  </div>

  <table class="table-fixe w-full text-sm">
    <thead class="text-xs font-medium uppercase text-gray-400 bg-gray-50">
      <tr>
        <th class="p-1 whitespace-wrap">
          <div class="font-medium text-left">Nom</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-medium text-left">Description</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-medium text-left">category</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-medium text-center">Actions</div>
        </th>
      </tr>
    </thead>
    <tbody class="text-xs m divide-y divide-gray-100">
      <tr v-for="statue in this.history_statues" v-bind:key="statue.id">
        <td class="p-1 whitespace-wrap">{{ statue.name }}</td>
        <td class="p-1 whitespace-wrap">{{ statue.description }}</td>
        <td class="p-1 whitespace-wrap">{{ statue.category_id }}</td>

        <td class="p-1 whitespace-wrap flex items-center justify-center">
          <a href="#" @click="showUpdateStatueModal(statue.id)">
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
          <a href="#" @click="deleteStatue(statue.id)">
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
    :showUpdateModal="displayHistoryStatuesModal"
    :ChildCategories="ChildCategories"
    :statue="statue"
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
      statue: this.statue,
      displayHistoryStatuesModal: false,
    };
  },

  props: ["ChildCategories", "history_statues", "statue", "globalClass"],

  mounted() {},

  methods: {
    showUpdateStatueModal(id) {
      axios.get(`/history_statues/${id}`).then((res) => {
        this.statue.id = res.data.id;
        this.statue.name = res.data.name;
        this.statue.description = res.data.description;
        this.statue.category_id = res.data.category_id;
      });

      this.displayHistoryStatuesModal = true;
    },

    deleteStatue(id) {
      this.$inertia.delete(`/history_statues/${id}`);
    },

    closeUpdateModal() {
      this.statue = {
        name: null,
        description: null,
        category_id: null,
      };
      this.displayHistoryStatuesModal = false;
    },
  },
};
</script>

<style>
</style>