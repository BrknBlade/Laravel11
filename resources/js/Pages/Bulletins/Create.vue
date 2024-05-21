<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'

const props = defineProps({
  categories: Array,
})

const form = useForm({
  title: '',
  content: '',
  category_id: '',
})

const submit = () => {
  form.post(route('bulletins.store'))
}
</script>

<template>
  <Head title="Anuncios" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Anuncios
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center"
        >
          <form @submit.prevent="submit" class="flex flex-col gap-2 w-2/3">
            <InputLabel for="title" value="Titulo" />
            <TextInput id="title" v-model="form.title" />
            <InputError :message="form.errors.title" />

            <InputLabel for="content" value="Contenido" />
            <TextInput id="content" v-model="form.content" />
            <InputError :message="form.errors.content" />

            <InputLabel for="categories" value="Categoria" />
            <select
              v-model="form.category_id"
              name="categories"
              id="categories"
              class="mt-2"
            >
              <option v-for="category in categories" :value="category.id">
                {{ category.name }}
              </option>
            </select>
            <InputError :message="form.errors.category_id" />

            <div class="flex gap-2">
              <PrimaryButton>Subir</PrimaryButton>
              <LinkButton :href="route('bulletins.index')" color="danger"
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
