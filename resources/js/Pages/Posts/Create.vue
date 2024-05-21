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

const submit = () => {
  form.post(route('posts.store'))
}
</script>

<template>
  <Head title="ChangeMe" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Crear un post
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center"
        >
          <form @submit.prevent="submit" class="w-full flex flex-col">
            <div>
              <InputLabel for="title" value="Titulo" />
              <TextInput id="title" v-model="form.title" class="mb-6 w-full" />
              <InputError :message="form.errors.title" />
            </div>
            <div>
              <InputLabel for="contetn" value="Contenido" />
              <TextInput
                id="content"
                v-model="form.content"
                class="mb-4 w-full"
              />
              <InputError :message="form.errors.title" />
            </div>

            <div class="flex gap-2 w-full">
              <PrimaryButton>Subir</PrimaryButton>
              <LinkButton :href="route('posts.index')" color="danger"
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
