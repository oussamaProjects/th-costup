<template>
  <div class="flex flex-row gap-2">
    <div class="flex flex-col">
      <div class="text-x">Shift 1</div>
      <div class="w-full grid grid-cols-2 gap-x-3">
        <div class="mt-1 mb-2">
          <div class="text-x">standard</div>
          <input
            id="standard1"
            @change="change"
            v-model="param.shift1.standard"
            type="text"
            placeholder="Resource"
            :class="this.globalClass.inputTextForm"
          />
        </div>

        <div class="mt-1 mb-2">
          <div class="text-x">day Per Week</div>
          <select
            dayPerWeek=""
            id="dayPerWeek1"
            @change="change"
            v-model="param.shift1.dayPerWeek"
            :class="this.globalClass.inputTextForm"
          >
            <option value="0">--</option>
            <option value="6">6/7</option>
            <option value="7">7/7</option>
          </select>
        </div>
      </div>
    </div>

    <div class="flex flex-col">
      <div class="text-x">Shift 2</div>
      <div class="w-full grid grid-cols-2 gap-x-3">
        <div class="mt-1 mb-2">
          <div class="text-x">standard</div>
          <input
            id="standard2"
            @change="change"
            v-model="param.shift2.standard"
            type="text"
            placeholder="Resource"
            :class="this.globalClass.inputTextForm"
          />
        </div>

        <div class="mt-1 mb-2">
          <div class="text-x">day Per Week</div>
          <select
            dayPerWeek=""
            id="dayPerWeek2"
            @change="change"
            v-model="param.shift2.dayPerWeek"
            :class="this.globalClass.inputTextForm"
          >
            <option value="0">--</option>
            <option value="6">6/7</option>
            <option value="7">7/7</option>
          </select>
        </div>
      </div>
    </div>

    <div class="flex flex-col">
      <div class="text-x">Shift 3</div>
      <div class="w-full grid grid-cols-2 gap-x-3">
        <div class="mt-1 mb-2">
          <div class="text-x">standard</div>
          <input
            id="standard3"
            @change="change"
            v-model="param.shift3.standard"
            type="text"
            placeholder="Resource"
            :class="this.globalClass.inputTextForm"
          />
        </div>

        <div class="mt-1 mb-2">
          <div class="text-x">day Per Week</div>
          <select
            dayPerWeek=""
            id="dayPerWeek3"
            @change="change"
            v-model="param.shift3.dayPerWeek"
            :class="this.globalClass.inputTextForm"
          >
            <option value="0">--</option>
            <option value="6">6/7</option>
            <option value="7">7/7</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <div class="flex flex-row justify-center gap-4 py-6">
    <div class="flex flex-row gap-1 w-1/3">
      <div v-for="day in this.days" :key="day" class="flex flex-col gap-1">
        <div class="font-medium" v-if="day == 1">M</div>
        <div class="font-medium" v-if="day == 2">T</div>
        <div class="font-medium" v-if="day == 3">W</div>
        <div class="font-medium" v-if="day == 4">T</div>
        <div class="font-medium" v-if="day == 5">F</div>
        <div class="font-medium" v-if="day == 6">S</div>
        <div class="font-medium" v-if="day == 7">S</div>
        <div
          v-for="shift in this.shifts"
          :key="shift"
          class="flex flex-row gap-1"
        >
          <input
            type="text"
            :id="'shift_' + day + '_' + shift"
            :class="globalClass.inputTextForm"
          />
        </div>
      </div>
    </div>
    <div class="flex flex-row py-6 gap-6 w-2/3">
      <div class="flex flex-col gap-2 flex-1">
        <div class="flex flex-row">
          <div class="w-52">Shift Morning Gap</div>
          <div id="shiftMorningGap" class="w-6"></div>
        </div>

        <div class="flex flex-row">
          <div class="w-52">Shift Evening Gap</div>
          <div id="shiftEveningGap" class="w-6"></div>
        </div>

        <div class="flex flex-row">
          <div class="w-52">Shift Afternoon Gap</div>
          <div id="shiftAfternoonGap" class="w-6"></div>
        </div>
      </div>

      <div class="flex flex-col gap-2 flex-1">
        <div class="flex flex-row">
          <div class="flex-1">NBR rest days/Morning shift</div>
          <div id="ngaMorningActual" class="w-6"></div>
        </div>

        <div class="flex flex-row">
          <div class="flex-1">NBR rest days/Evening shift</div>
          <div id="ngaEveningActual" class="w-6"></div>
        </div>

        <div class="flex flex-row">
          <div class="flex-1">NBR rest days/Afternoon shift</div>
          <div id="ngaAfternoonActual" class="w-6"></div>
        </div>
      </div>

      <div class="flex flex-col gap-2 flex-1">
        <div class="flex flex-row">
          <div class="flex-1">ngaTotal</div>
          <div id="ngaTotal" class="w-6"></div>
        </div>

        <div class="flex flex-row">
          <div class="flex-1">NBR Rotateur</div>
          <div id="nbrRotator" class="w-6"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="w-full flex flex-col">
    <div class="my-2 w-44 ml-auto">
      <button @click="display" :class="this.globalClass.buttonForm">
        Calculate
      </button>
    </div>
  </div>
</template>

<script>
export default {
  components: {},

  data() {
    return {
      param: {
        shift1: { standard: 0, dayPerWeek: 0 },
        shift2: { standard: 0, dayPerWeek: 0 },
        shift3: { standard: 0, dayPerWeek: 0 },
      },
      days: [1, 2, 3, 4, 5, 6, 7],
      shifts: [1, 2, 3],
      monthWeeks: 4,
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

  mounted() {
    this.days.forEach((day) => {
      this.shifts.forEach((shift) => {
        document.getElementById("shift_" + day + "_" + shift).value = 0;
      });
    });
  },

  methods: {
    formChanged() {
      this.uttDisplay = false;
      this.upatDisplay = false;
    },

    calcByResource() {
      this.resourceNevelingCalc();
      this.PATNevelingCalc();
      this.uttDisplay = true;
      this.upatDisplay = true;
    },

    display() {
      var shiftMorningActual = 0;
      var shiftEveningActual = 0;
      var shiftAfternoonActual = 0;

      this.days.forEach((day) => {
        this.shifts.forEach((shift) => {
          if (shift == 1)
            shiftMorningActual +=
              parseInt(
                document.getElementById("shift_" + day + "_" + shift).value
              ) ?? 0;

          if (shift == 2)
            shiftEveningActual +=
              parseInt(
                document.getElementById("shift_" + day + "_" + shift).value
              ) ?? 0;

          if (shift == 3)
            shiftAfternoonActual +=
              parseInt(
                document.getElementById("shift_" + day + "_" + shift).value
              ) ?? 0;
        });
      });

      var shiftMorningActual = shiftMorningActual * this.monthWeeks;
      var shiftEveningActual = shiftEveningActual * this.monthWeeks;
      var shiftAfternoonActual = shiftAfternoonActual * this.monthWeeks;

      console.log("shiftMorningActual " + shiftMorningActual);
      console.log("shiftEveningActual " + shiftEveningActual);
      console.log("shiftAfternoonActual " + shiftAfternoonActual);

      var shiftMorningStandard =
        this.param.shift1.standard *
        this.param.shift1.dayPerWeek *
        this.monthWeeks;
      var shiftEveningStandard =
        this.param.shift2.standard *
        this.param.shift2.dayPerWeek *
        this.monthWeeks;
      var shiftAfternoonStandard =
        this.param.shift3.standard *
        this.param.shift3.dayPerWeek *
        this.monthWeeks;

      console.log("shiftMorningStandard " + shiftMorningStandard);
      console.log("shiftEveningStandard " + shiftEveningStandard);
      console.log("shiftAfternoonStandard " + shiftAfternoonStandard);

      var shiftMorningGap = shiftMorningStandard - shiftMorningActual;
      var shiftEveningGap = shiftEveningStandard - shiftEveningActual;
      var shiftAfternoonGap = shiftAfternoonStandard - shiftAfternoonActual;

      console.log("shiftMorningGap " + shiftMorningGap);
      console.log("shiftEveningGap " + shiftEveningGap);
      console.log("shiftAfternoonGap " + shiftAfternoonGap);

      document.getElementById("shiftMorningGap").innerHTML = shiftMorningGap;
      document.getElementById("shiftEveningGap").innerHTML = shiftEveningGap;
      document.getElementById("shiftAfternoonGap").innerHTML =
        shiftAfternoonGap;

      var ngaMorningActual = 0;
      var ngaEveningActual = 0;
      var ngaAfternoonActual = 0;
      var ngaTotal = 0;
      var nbrRotator = 0;

      this.days.forEach((day) => {
        this.shifts.forEach((shift) => {
          if (shift == 1 && day == 7)
            ngaMorningActual +=
              parseInt(
                document.getElementById("shift_" + day + "_" + shift).value
              ) ?? 0;

          if (shift == 2 && day == 7)
            ngaEveningActual +=
              parseInt(
                document.getElementById("shift_" + day + "_" + shift).value
              ) ?? 0;

          if (shift == 3 && day == 7)
            ngaAfternoonActual +=
              parseInt(
                document.getElementById("shift_" + day + "_" + shift).value
              ) ?? 0;
        });
      });

      console.log("ngaMorningActual " + ngaMorningActual);
      console.log("ngaEveningActual " + ngaEveningActual);
      console.log("ngaAfternoonActual " + ngaAfternoonActual);

      ngaMorningActual = ngaMorningActual * this.monthWeeks;
      ngaEveningActual = ngaEveningActual * this.monthWeeks;
      ngaAfternoonActual = ngaAfternoonActual * this.monthWeeks;

      document.getElementById("ngaMorningActual").innerHTML = ngaMorningActual;
      document.getElementById("ngaEveningActual").innerHTML = ngaEveningActual;
      document.getElementById("ngaAfternoonActual").innerHTML =
        ngaAfternoonActual;

      ngaTotal = ngaMorningActual + ngaEveningActual + ngaAfternoonActual;

      var dayOfAllWeek =
        parseInt(this.param.shift1.dayPerWeek) +
        parseInt(this.param.shift2.dayPerWeek) +
        parseInt(this.param.shift3.dayPerWeek);

      nbrRotator = ngaTotal / dayOfAllWeek;

      console.log("ngaTotal " + ngaTotal);
      console.log("dayOfAllWeek " + dayOfAllWeek);
      console.log("nbrRotator " + nbrRotator);

      document.getElementById("ngaTotal").innerHTML = ngaTotal;
      document.getElementById("nbrRotator").innerHTML = nbrRotator;
    },

    change() {
      this.days.forEach((day) => {
        this.shifts.forEach((shift) => {
          if (this.param.shift1.dayPerWeek >= day && shift == 1)
            document.getElementById("shift_" + day + "_" + shift).value =
              this.param.shift1.standard;

          if (this.param.shift2.dayPerWeek >= day && shift == 2)
            document.getElementById("shift_" + day + "_" + shift).value =
              this.param.shift2.standard;

          if (this.param.shift3.dayPerWeek >= day && shift == 3)
            document.getElementById("shift_" + day + "_" + shift).value =
              this.param.shift3.standard;
        });
      });
    },
  },
};
</script>

<style>
</style>