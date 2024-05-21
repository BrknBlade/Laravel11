<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'

const props = defineProps({
  bulletin: Object,
  categories: Array,
})

const form = useForm({
  title: props.bulletin.title,
  content: props.bulletin.content,
  category_id: props.bulletin.category.id,
  status: props.bulletin.status,
})

const submit = () => {
  form.patch(route('bulletins.update', props.bulletin))
}
</script>

<template>
  <Head title="Update Bulletin" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Update Bulletin
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center"
        >
          <form @submit.prevent="submit" class="w-2/3">
            <InputLabel for="title" value="Titulo" />
            <TextInput id="title" v-model="form.title" class="w-full" />
            <InputError :message="form.errors.title" />

            <InputLabel for="content" value="Contenido" />
            <TextInput id="content" v-model="form.content" class="w-full" />
            <InputError :message="form.errors.content" />

            <InputLabel for="categories" value="Categoria" />
            <select
              v-model="form.category_id"
              id="categories"
              class="w-full mb-4"
            >
              <option v-for="category in categories" :value="category.id">
                {{ category.name }}
              </option>
            </select>
            <div class="flex gap-2">
              <PrimaryButton>Actualizar</PrimaryButton>
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
