<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'
import { computed, ref } from 'vue'

defineProps({
  users: Array,
})
</script>

<template>
  <Head title="Admin - Users" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Admin - Users
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex justify-center gap-4"
        >
          <article
            v-for="user in users"
            class="p-4 rounded bg-slate-600 text-white"
          >
            <p class="text-center font-bold text-lg">{{ user.name }}</p>
            <img src="./img/userImg.jpg" width="150" class="rounded-full" />
          </article>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped></style>
