<template>
  <div
    v-if="$page.props.flash.failures.list.clients"
    class="alert w-full text-xs text-error px-3 py-1 my-2 text-center"
  >
    {{ $page.props.flash.failures.list.clients }}
  </div>

  <div
    v-if="$page.props.flash.success.list.clients"
    class="alert w-full text-xs text-success px-3 py-1 my-2 text-center"
  >
    {{ $page.props.flash.success.list.clients }}
  </div>
  <table class="table-fixe w-full text-sm">
    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
      <tr>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">Nom</div>
        </th>
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">Address</div>
        </th> 
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left">Description</div>
        </th> 
        <th class="p-1 whitespace-wrap">
          <div class="font-semibold text-left text-center">Actions</div>
        </th>
      </tr>
    </thead>
    <tbody class="text-xs m divide-y divide-gray-100">
      <tr v-for="client in this.clients" v-bind:key="client.id">
        <td class="p-1 whitespace-wrap">{{ client.name }}</td>
        <td class="p-1 whitespace-wrap">{{ client.address }}</td> 
        <td class="p-1 whitespace-wrap">{{ client.description }}</td> 

        <td class="p-1 whitespace-wrap flex items-center justify-center">
          <a href="#" @click="showUpdateClientsModal(client.id)">
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
          <a href="#" @click="deleteClient(client.id)">
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
    :showUpdateModal="displayUpdateClientsModal"
    :client="client"
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
      client: this.client,
      displayUpdateClientsModal: false,
    };
  },

  props: [ "client", "clients", "globalClass"],

  mounted() {},

  methods: {
    showUpdateClientsModal(id) {
      axios.get(`/clients/${id}`).then((res) => {
        console.log(res.data);
        this.client.id = res.data.id;
        this.client.name = res.data.name;
        this.client.address = res.data.address;
        this.client.description = res.data.description; 
      });

      this.displayUpdateClientsModal = true;
    },

    deleteClient(id) {
      this.$inertia.delete(`/clients/${id}`);
    },

    closeUpdateModal() {
      this.client = {
        name: null,
        address: null, 
        description: null, 
      };
      this.displayUpdateClientsModal = false;
    },
  },
};
</script>

<style>
</style>