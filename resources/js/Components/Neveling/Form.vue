<template>
  <form @submit.prevent="submit" class="bg-white">
    <div class="flex flex-col -mb-2">
      <div class="w-full grid grid-cols-3 gap-x-3">
        <div class="mb-2">
          <div class="text-x">Customer demand</div>
          <input
            id="cd"
            v-model="param.cd"
            type="text"
            @change.prevent="formChanged"
            placeholder="Customer demand"
            :class="this.globalClass.inputTextForm"
          />
        </div>
        <div class="mb-2">
          <div class="text-x">Production Available time</div>
          <input
            id="pat"
            v-model="param.pat"
            type="text"
            @change.prevent="formChanged"
            placeholder="Production Available time"
            :class="this.globalClass.inputTextForm"
          />
        </div>
      </div>

      <div class="w-full grid grid-cols-3 gap-x-3">
        <div class="mb-2">
          <div class="text-x">Tack time</div>
          <input
            id="tt"
            v-model="param.tt"
            type="text"
            @change.prevent="formChanged"
            placeholder="Tack time"
            :class="this.globalClass.inputTextForm"
          />
        </div>
        <div class="mb-2">
          <div class="text-x">Shift</div>
          <input
            id="shift"
            v-model="param.shift"
            type="text"
            @change.prevent="formChanged"
            placeholder="Shift"
            :class="this.globalClass.inputTextForm"
          />
        </div>
      </div>

      <div class="w-full flex flex-row mt-2">
        <div class="mb-2">
          <a
            @click="resourceNevelingCalc"
            class="block"
            :class="this.globalClass.link"
          >
            resource Neveling Calculation
          </a>
        </div>

        <div class="mb-2 ml-4">
          <a
            @click="PATNevelingCalc"
            class="block"
            :class="this.globalClass.link"
          >
            PAT Neveling Calculation
          </a>
        </div>
      </div>

      <div class="w-full flex flex-col gap-2">
        <div
          class="flex flex-col gap-2 p-2 shadow bg-gray-100 text-sm"
          :class="{ hidden: !uttDisplay }"
        >
          <div class="text-lg py-1 font-medium">
            Resource Neveling Calculation
          </div>

          <div class="grid grid-cols-2 w-1/2">
            <div class="font-medium">Updated tackt time</div>
            <div id="utt" class="utt text-custom_red font-bold"></div>

            <div class="font-medium">Updated Resources</div>
            <div
              id="UpdatedNbrResources_utt"
              class="text-custom_red font-bold"
            ></div>

            <div class="">ATT</div>
            <div id="rnc_att" class="text-custom_red"></div>

            <div class="">STT</div>
            <div id="rnc_stt" class="text-custom_red"></div>

            <div class="">GTT</div>
            <div id="rnc_gtt" class="text-custom_red"></div>
          </div>
        </div>

        <div
          class="flex flex-col gap-2 p-2 shadow bg-gray-100 text-sm"
          :class="{ hidden: !upatDisplay }"
        >
          <div class="text-lg py-1 font-medium">
            Production Available time Neveling Calculation
          </div>

          <div class="grid grid-cols-2 w-1/2">
            <div class="font-medium">Updated Production Available time</div>
            <div id="upat" class="upat text-custom_red font-bold"></div>

            <div class="font-medium">Updated Resources</div>
            <div
              id="UpdatedNbrResources_upat"
              class="text-custom_red font-bold"
            ></div>

            <div class="">ATT</div>
            <div id="pnc_att" class="text-custom_red"></div>

            <div class="">STT</div>
            <div id="pnc_stt" class="text-custom_red"></div>

            <div class="">GTT</div>
            <div id="pnc_gtt" class="text-custom_red"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="w-full flex flex-col">
    <div class="mb-2 w-44 ml-auto">
    <button
    type="submit"
    :disabled="param.processing"
    :class="this.globalClass.buttonForm"
    >
    Enregistrer
    </button>
    </div>
    </div> -->
  </form>
</template>

<script>
export default {
  components: {},

  data() {
    return {
      param: {
        cd: 3120,
        pat: 40,
        tt: 17,
        shift: 7,
      },
      upatDisplay: false,
      uttDisplay: false,
    };
  },

  computed: {
    // nbrResources() {
    //   var nbrResources = this.param.cd / this.param.pat / this.param.tt;
    //   console.log(nbrResources);
    //   return nbrResources;
    // },
    // UpdatedNbrResources() {
    //   var UpdatedNbrResources = nbrResources - floor(nbrResources);
    //   console.log(UpdatedNbrResources);
    //   return UpdatedNbrResources;
    // },
  },
  props: ["params", "globalClass"],

  mounted() {},

  methods: {
    formChanged() {
      this.uttDisplay = false;
      this.upatDisplay = false;
    },
    resourceNevelingCalc() {
      var nbrResources = 0;
      var UpdatedNbrResources = 0;
      var stta = 0;
      var uatta = 0;
      var gtta = 0;
      var gtt = 0;
      var utt = 0;

      nbrResources =
        parseInt(this.param.cd) /
        parseInt(this.param.pat) /
        parseInt(this.param.tt);
      nbrResources = parseFloat(nbrResources);
      console.log("nbrResources " + nbrResources);

      UpdatedNbrResources = Math.floor(nbrResources);
      console.log("UpdatedNbrResources " + UpdatedNbrResources);

      document.getElementById("rnc_att").innerHTML = parseInt(this.param.tt);

      stta = nbrResources * parseInt(this.param.tt);
      console.log("stta " + stta);

      uatta = UpdatedNbrResources * parseInt(this.param.tt);
      console.log("uatta " + uatta);

      gtta = stta - uatta;
      console.log("gtta " + gtta);

      if (gtta != 0) gtt = gtta / UpdatedNbrResources;
      console.log("gtt " + gtt);

      document.getElementById("rnc_gtt").innerHTML = gtt;

      utt = gtt + parseInt(this.param.tt);
      console.log("Updated tackt time " + utt);

      document.getElementById("rnc_stt").innerHTML = utt;

      document.getElementById("UpdatedNbrResources_utt").innerHTML =
        UpdatedNbrResources;
      document.getElementById("utt").innerHTML = utt;

      document.getElementById("UpdatedNbrResources_upat").innerHTML = "";
      document.getElementById("upat").innerHTML = "";

      this.uttDisplay = true;
      this.upatDisplay = false;
    },

    PATNevelingCalc() {
      var nbrResources = 0;
      var UpdatedNbrResources = 0;
      var stta = 0;
      var uatta = 0;
      var gtta = 0;
      var upat = 0;

      nbrResources =
        parseInt(this.param.cd) /
        parseInt(this.param.pat) /
        parseInt(this.param.tt);
      nbrResources = parseFloat(nbrResources);
      console.log("nbrResources " + nbrResources);

      UpdatedNbrResources = Math.ceil(nbrResources);
      console.log("UpdatedNbrResources " + UpdatedNbrResources);

      document.getElementById("pnc_att").innerHTML = parseInt(this.param.tt);
      document.getElementById("pnc_stt").innerHTML = parseInt(this.param.tt);
      document.getElementById("pnc_gtt").innerHTML = 0;

      stta = nbrResources * parseInt(this.param.tt);
      console.log("stta " + stta);

      uatta = UpdatedNbrResources * parseInt(this.param.tt);
      console.log("uatta " + uatta);

      gtta = stta - uatta;
      console.log("gtta " + gtta);

      upat = parseInt(this.param.pat) + parseInt(gtta);
      console.log("Updated Production Available time " + upat);

      document.getElementById("UpdatedNbrResources_upat").innerHTML =
        UpdatedNbrResources;
      document.getElementById("upat").innerHTML = upat;

      document.getElementById("UpdatedNbrResources_utt").innerHTML = "";
      document.getElementById("utt").innerHTML = "";

      this.upatDisplay = true;
      this.uttDisplay = false;
    },

    submit() {
      this.$inertia.post("/params", this.param);
      this.param.id = null;
      this.param.cd = null;
      this.param.pat = null;
      this.param.tt = null;
      this.param.shift = null;
    },
  },
};
</script>

<style>
</style>