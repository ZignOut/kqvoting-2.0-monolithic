<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nominee</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <ul class="flex flex-col">
            <label for="name">Name: </label>
            <input type="text" name="name" v-model="nominee.name" />
            <label for="class">Class: </label>
            <input type="text" name="class" v-model="nominee.class" />
            <label for="age">Age: </label>
            <input type="text" name="age" v-model="nominee.age" />
            <label for="hobby">Hobby: </label>
            <input type="text" name="hobby" v-model="nominee.hobby" />
            <label for="description">Description: </label>
            <input
              type="text"
              name="description"
              v-model="nominee.description"
            />

            <li>
              <a
                :href="route('nominees.home')"
                class="text-lg text-blue-500 hover:text-blue-400"
                >Back</a
              >

              <!-- Update Button -->
              <inertia-link
                :href="route('nominees.update', nominee.id)"
                method="put"
                :data="nominee"
                as="button"
                type="button"
                class="text-lg text-green-500 hover:text-green-400"
              >
                Update
              </inertia-link>

              <!-- Delete Button -->
              <inertia-link
                :href="route('nominees.delete', nominee.id)"
                method="delete"
                as="button"
                type="button"
                class="text-lg text-red-500 hover:text-red-400"
              >
                Delete
              </inertia-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
  props: {
    nominee: Object,
  },

  components: {
    AppLayout,
  },
};
</script>
