<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

// Props
defineProps({
  jobPostings: Array,
  skills: Array,
});

// Reactive form data
const form = ref({
  title: "",
  description: "",
  company_name: "",
  experience: "",
  salary: "",
  location: "",
  skills: [],
});

// Submit form data
const submit = () => {
  Inertia.post("/job-postings", form.value);
};

// Delete a job posting
const deleteJob = (id) => {
  Inertia.delete(`/job-postings/${id}`);
};
</script>

<style scoped>
.input {
  @apply border rounded-md p-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500;
}
.textarea {
  @apply border rounded-md p-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500;
}
.select {
  @apply border rounded-md p-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500;
}
.btn {
  @apply bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600;
}
</style>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <div>
      <!-- Heading -->
      <h1 class="text-2xl font-bold mb-4">Job Postings</h1>

      <!-- Form Section -->
      <form @submit.prevent="submit" class="grid grid-cols-2 gap-4">
        <!-- Left Column -->
        <div>
          <input
            v-model="form.title"
            placeholder="Job Title"
            class="input w-full"
          />
          <textarea
            v-model="form.description"
            placeholder="Description"
            class="textarea w-full mt-4"
            rows="4"
          ></textarea>
        </div>

        <!-- Right Column -->
        <div>
          <input
            v-model="form.company_name"
            placeholder="Company Name"
            class="input w-full"
          />
          <input
            v-model="form.experience"
            placeholder="Experience"
            class="input w-full mt-4"
          />
        </div>

        <!-- Full Width Inputs -->
        <div class="col-span-2 grid grid-cols-2 gap-4">
          <input
            v-model="form.salary"
            placeholder="Salary"
            class="input w-full"
          />
          <input
            v-model="form.location"
            placeholder="Location"
            class="input w-full"
          />
        </div>

        <!-- Skills Dropdown -->
        <div class="col-span-2">
          <select
            v-model="form.skills"
            multiple
            class="select w-full"
          >
            <option
              v-for="skill in skills"
              :value="skill.id"
              :key="skill.id"
            >
              {{ skill.name }} 
            </option>
          </select>
        </div>

        <!-- Submit Button -->
        <div class="col-span-2">
          <button
            type="submit"
            class="btn btn-primary w-full"
          >
            Create
          </button>
        </div>
      </form>

      <!-- Job Listings Section -->
      <div class="mt-8">
          <h2 class="text-xl font-semibold mb-4">Existing Job Postings List</h2>
          <table class="table-auto border-collapse w-full text-left">
            <thead>
              <tr class="bg-gray-200">
                <th class="border p-2">Title</th>
                <th class="border p-2">Description</th>
                <th class="border p-2">Company Name</th>
                <th class="border p-2">Experience</th>
                <th class="border p-2">Salary</th>
                <th class="border p-2">Location</th>
                <th class="border p-2">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="job in jobPostings"
                :key="job.id"
                class="hover:bg-gray-100"
              >
                <td class="border p-2">{{ job.title }}</td>
                <td class="border p-2">{{ job.description }}</td>
                <td class="border p-2">{{ job.company_name }}</td>
                <td class="border p-2">{{ job.experience }}</td>
                <td class="border p-2">{{ job.salary }}</td>
                <td class="border p-2">{{ job.location }}</td>
                <td class="border p-2">
                  <button
                    @click="deleteJob(job.id)"
                    class="btn btn-danger"
                  >
                    Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
  </AuthenticatedLayout>
</template>
