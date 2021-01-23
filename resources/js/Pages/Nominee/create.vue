<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nominee</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form
          class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-col"
          @submit.prevent="submit"
        >
          <label for="name">Name: </label>
          <input type="text" name="name" v-model="user_form.name" />
          <label for="class">Class: </label>
          <input type="text" name="class" v-model="user_form.class" />
          <label for="age">Age: </label>
          <input type="text" name="age" v-model="user_form.age" />
          <label for="hobby">Hobby: </label>
          <input type="text" name="hobby" v-model="user_form.hobby" />
          <label for="description">Description: </label>
          <input
            type="text"
            name="description"
            v-model="user_form.description"
          />

          <button
            type="submit"
            class="my-6 bg-indigo-600 px-4 py-1 text-white rounded-lg text-sm hover:bg-indigo-500 focus:bg-indigo-700"
          >
            Submit
          </button>
        </form>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
  data: () => {
    return {
      user_form: {
        name: null,
        class: null,
        age: null,
        hobby: null,
        description: null,
      },
    };
  },

  components: {
    AppLayout,
  },

  methods: {
    submit() {
      this.$inertia.post("/nominees", this.user_form);
    },
  },
};
</script>
