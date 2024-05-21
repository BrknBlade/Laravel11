<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'

defineProps({
  posts: Array,
})
</script>

<template>
  <Head title="Admin - Posts" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Admin - Posts
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="w-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col align-middle"
        >
          <LinkButton
            :href="route('admin.posts.create')"
            class="self-center mb-2"
            >Crear un post</LinkButton
          >
          <div class="flex justify-center gap-4">
            <article
              v-for="post in posts"
              class="w-60 max-h-96 bg-slate-600 rounded text-white flex flex-col items-center p-4 gap-4"
            >
              <p class="font-bold text-lg text-center">{{ post.title }}</p>
              <LinkButton :href="route('admin.posts.show', post)" color="none">
                <img
                  src="./img/dias-entrenar.webp"
                  class="rounded hover:scale-105 transition-all cursor-pointer"
                />
              </LinkButton>
              <p class="texto">{{ post.content }}</p>

              <div class="flex gap-2">
                <LinkButton :href="route('admin.posts.edit', post)" color="info"
                  >Editar</LinkButton
                >
                <LinkButton
                  :href="route('admin.posts.destroy', post)"
                  method="delete"
                  as="button"
                  color="danger"
                  >Borrar</LinkButton
                >
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.texto {
  text-align: center;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 5;
  line-clamp: 2;
  -webkit-box-orient: vertical;
}
</style>
