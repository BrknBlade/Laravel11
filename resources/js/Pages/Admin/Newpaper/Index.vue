<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'

const props = defineProps({
  noticias: Array,
})
</script>

<template>
  <Head title="Admin - News" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Admin - News
      </h2>
    </template>

    <div class="py-12">
      <div class="w-full mx-auto sm:px-6 lg:px-8">
        <div
          class="w-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col gap-4 items-center flex-wrap"
        >
          <LinkButton :href="route('admin.newspaper.create')"
            >Crear Noticia</LinkButton
          >
          <article
            v-for="noticia in noticias"
            class="w-96 max-h-80 flex flex-col items-center overflow-hidden bg-slate-400 p-4 rounded"
          >
            <p class="font-bold text-center">{{ noticia.title }}</p>
            <div class="newpaper_img"></div>
            <p class="texto">{{ noticia.content }}</p>

            <div class="flex gap-2">
              <LinkButton
                :href="route('admin.newspaper.edit', noticia)"
                color="info"
                >Editar</LinkButton
              >
              <LinkButton
                :href="route('admin.newspaper.destroy', noticia)"
                method="delete"
                as="button"
                color="danger"
                >Eliminar</LinkButton
              >
            </div>
          </article>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.newpaper_img {
  min-width: 8rem;
  min-height: 8rem;
  background: #888;
  box-shadow: inset 0 0 2rem #444;
  border-radius: 0.2rem;
}

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
