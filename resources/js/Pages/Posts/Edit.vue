<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({
  post: Object,
})

const form = useForm({
  title: props.post.title,
  content: props.post.content,
})

const submit = () => {
  form.patch(route('posts.update', props.post))
}
</script>

<template>
  <Head title="Edit post" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit post
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center"
        >
          <form @submit.prevent="submit" class="w-full">
            <div>
              <InputLabel for="title" value="Titulo" />
              <TextInput id="title" v-model="form.title" class="w-full mb-4" />
              <inputError :message="form.errors.title" />
            </div>

            <div>
              <InputLabel for="content" value="Contenido" />
              <TextInput
                id="content"
                v-model="form.content"
                class="w-full mb-2"
              />
              <inputError :message="form.errors.content" />
            </div>

            <div class="flex gap-2 mt-4">
              <PrimaryButton>Actualizar</PrimaryButton>
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
