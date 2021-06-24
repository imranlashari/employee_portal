<template>
  <layout>
    <div class="max-w-7xl mx-auto px-8 py-8">
      <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
        <div class="grid grid-cols-1 gap-4 p-4">
          <h3 class="text-red-600"><span class="font-bold">{{ already }}</span></h3>
          <h3 class="text-red-600"><span class="font-bold">{{ end_msg }}</span></h3>
        </div>
        <div class="grid grid-cols-2 gap-4 p-16">
          <div class="text-center bg-gray-200 rounded p-10 hover:shadow-xl">
            <p class="text-2xl font-bold">Click to Start Clock</p>
            <button
              type="button"
              @click="clockin()"
              class="
                w-32
                mt-4
                bg-blue-500
                hover:bg-blue-700
                text-white
                font-bold
                py-2
                px-4
                rounded
              "
            >
              Start
            </button>
            <p class="mt-5">
              Your time has been started at:
              <span class="font-bold">{{ start_res }}</span>
            </p>
          </div>
          <div class="text-center bg-gray-200 rounded p-10 hover:shadow-xl">
            <p class="text-2xl font-bold">Click to Stop Clock</p>
            <button
              type="button"
              @click="clockout()"
              class="
                w-32
                mt-4
                bg-blue-500
                hover:bg-blue-700
                text-white
                font-bold
                py-2
                px-4
                rounded
              "
            >
              Stop
            </button>
            <p class="mt-5">
              Your time has been end at:
              <span class="font-bold">{{ end_res }}</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </layout>
</template>

<script>
import Layout from "@/Layouts/Layout";

export default {
  data() {
    return {
      start_res: "",
      end_res: "",
      end_msg:"",
      total_hours:"",
      already:""
    };
  },

created() {
  
},

  components: {
    Layout,
  },
  computed: {

  },
  methods: {
    clockin() {
      // this.$inertia.get(route("clockin"));
      // axios.get("/clockin").then((response) => (this.start_res = response.data));
      axios.get("/clockin").then((response) => (this.already = response.data[0].already, this.start_res = response.data[0].start_res));
    },
    clockout() {
      // this.$inertia.get(route("clockout"));
      axios.get("/clockout").then((response) => (this.end_msg = response.data[0].end_msg, this.end_res = response.data[0].end_res));
    },
  },
};
</script>
