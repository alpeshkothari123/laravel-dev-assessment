<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
    <div class="container mx-auto p-6">
      <h1 class="text-2xl font-bold mb-4">Skills Management</h1>
  
    
      <div class="flex gap-8">
        <!-- Skills Table -->
        <div class="w-1/2">
          <table class="table-auto w-full border border-gray-200">
            <thead>
              <tr class="bg-gray-100">
                <th class="border px-4 py-2">Skill</th>
                <th class="border px-4 py-2">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="skill in skills" :key="skill.id">
                <td class="border px-4 py-2">{{ skill.name }}</td>
                <td class="border px-4 py-2">
                  <button @click="editSkill(skill)" class="bg-blue-500 text-white px-3 py-1 rounded mr-2">Edit</button>
                  <button @click="deleteSkill(skill.id)" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
  
        <!-- Add/Edit Form -->
        <div class="w-1/2">
          <form @submit.prevent="submitForm" class="bg-gray-100 p-4 rounded shadow-md">
            <h2 class="text-lg font-bold mb-4">{{ editMode ? 'Edit Skill' : 'Add New Skill' }}</h2>
            <div class="mb-4">
              <label for="name" class="block text-sm font-medium mb-2">Skill Name</label>
              <input v-model="form.name" id="name" type="text" class="border border-gray-300 rounded px-4 py-2 w-full" />
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
              {{ editMode ? 'Update' : 'Add' }}
            </button>
            <button v-if="editMode" @click="cancelEdit" type="button" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
              Cancel
            </button>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
  </template>
  
  <script>
  import { useForm } from '@inertiajs/vue3';
  
  export default {
    props: {
      skills: Array,
    },
    data() {
      return {
        form: useForm({
          name: '',
        }),
        editMode: false,
        editId: null,
      };
    },
    methods: {
      submitForm() {
        if (this.editMode) {
          this.form.put(route('skills.update', this.editId), {
            onSuccess: this.resetForm,
          });
        } else {
          this.form.post(route('skills.store'), {
            onSuccess: this.resetForm,
          });
        }
      },
      editSkill(skill) {
        this.editMode = true;
        this.editId = skill.id;
        this.form.name = skill.name;
      },
      deleteSkill(id) {
        if (confirm('Are you sure you want to delete this skill?')) {
          this.form.delete(route('skills.destroy', id));
        }
      },
      cancelEdit() {
        this.resetForm();
      },
      resetForm() {
        this.editMode = false;
        this.editId = null;
        this.form.reset();
      },
    },
  };
  </script>
  