<script setup>
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'

const props = defineProps({
  noticias: Array,
})
</script>

<template>
  <Head title="Profile" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tus Noticias
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-wrap gap-4 items-center justify-center"
        >
          <article v-for="noticia in noticias" class="new_container">
            <div class="content_container">
              <h2 class="font-bold text-xl text-center">{{ noticia.title }}</h2>
              <div class="new_img"></div>
              <p class="new_content">{{ noticia.content }}</p>
            </div>
            <nav class="action_buttons flex gap-2">
              <LinkButton
                :href="route('newspaper.destroy', noticia)"
                color="danger"
                method="delete"
                as="button"
                >Borrar</LinkButton
              >
              <LinkButton :href="route('newspaper.edit', noticia)" color="info"
                >Editar</LinkButton
              >
            </nav>
          </article>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.new_container {
  background: linear-gradient(to bottom, #999, #666);
  border-radius: 0.6rem;
  padding: 1rem;
  min-height: 25rem;
  max-height: 25rem;
  display: flex;
  flex-direction: column;

  .content_container {
    display: flex;
    width: 15rem;
    height: 100%;
    flex-direction: column;
    gap: 1.5rem;
    overflow: hidden;

    .new_img {
      background-color: #333;
      width: 8rem;
      height: 8rem;
      align-self: center;
      border-radius: 1rem;
    }

    .new_content {
      text-align: center;
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 5;
      line-clamp: 2;
      -webkit-box-orient: vertical;
    }
  }
}
</style>
