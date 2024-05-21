<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import LinkButton from '@/Components/LinkButton.vue'

const form = useForm({
  title: '',
  content: '',
})

function submit() {
  form.post(route('newspaper.store'))
}
</script>

<template>
  <Head title="Add Newspaper" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Añadir noticia
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="submit" class="flex flex-col">
            <div class="flex flex-col">
              <InputLabel for="title">Titulo</InputLabel>
              <TextInput id="title" type="text" v-model="form.title" />
              <InputError :message="form.errors.title" />
            </div>
            <div class="flex flex-col">
              <InputLabel for="content">Contenido</InputLabel>
              <TextInput id="content" type="text" v-model="form.content" />
              <InputError :message="form.errors.content" />
            </div>
            <div class="mt-4 flex gap-2">
              <PrimaryButton>Subir</PrimaryButton>
              <LinkButton :href="route('newspaper.index')" color="danger"
                >Cancelar</LinkButton
              >
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped></style>
