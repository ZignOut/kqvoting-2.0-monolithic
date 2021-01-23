<template>
  <app-layout>
    <template #header>
      <div class="flex">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Nominee
        </h2>

        <a
          :href="route('nominees.create')"
          class="ml-auto my-auto bg-indigo-600 px-4 py-1 text-white rounded-lg text-sm hover:bg-indigo-500 focus:bg-indigo-700"
          >Add Nominee</a
        >
      </div>
    </template>

    <div class="py-12 text-gray-800">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl sm:rounded-lg flex flex-wrap">
          <div v-for="nominee in nominees" :key="nominee.id" class="w-1/2 p-4">
            <div class="flex bg-white my-4 rounded-lg h-full">
              <div class="w-1/3 rounded-lg text-center m-10 bg-gray-600">
                Photo
              </div>
              <div class="w-2/3 py-10 pl-2 text-sm">
                <ul>
                  <li>Name: {{ nominee.name }}</li>
                  <li>Age: {{ nominee.age }}</li>
                  <li>Class: {{ nominee.class }}</li>
                  <li>Hobby: {{ nominee.hobby }}</li>
                  <li>Description: {{ nominee.description }}</li>
                  <li>
                    <a
                      :href="route('nominees.show', nominee.id)"
                      class="text-blue-400 hover:text-indigo-400"
                      >more details</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
  props: {
    nominees: Array,
  },

  components: {
    AppLayout,
  },
};
</script>
