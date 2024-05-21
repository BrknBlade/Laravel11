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
  form.post(route('admin.newspaper.store'))
}
</script>

<template>
  <Head title="ChangeMe" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ChangeMe
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center"
        >
          <form @submit.prevent="submit" class="flex flex-col w-full">
            <InputLabel for="title" value="Titulo" />
            <TextInput id="title" v-model="form.title" class="w-full" />
            <InputError :message="form.errors.title" />

            <InputLabel for="content" value="Contenido" />
            <TextInput id="content" v-model="form.content" class="w-full" />
            <InputError :message="form.errors.content" />

            <div class="flex gap-2 mt-2 self-start">
              <PrimaryButton>Publicar</PrimaryButton>
              <LinkButton :href="route('admin.newspaper.index')" color="danger"
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
