<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex justify-center"
        >
          <main v-role:any="'Admin'">
            <h2 class="p-4 bg-blue-800 rounded text-white w-96 text-center">
              Bienvenido {{ $page.props.auth.user.name }}
            </h2>
          </main>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
