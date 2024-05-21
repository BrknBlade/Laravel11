<script setup>
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'

const props = defineProps({
  noticias: Array,
})
</script>

<template>
  <Head title="Noticias" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Noticias
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center"
        >
          <LinkButton
            :href="route('newspaper.create')"
            v-role:any="'Admin'"
            class="inline-block mb-2"
            >Añadir noticia</LinkButton
          >
          <article
            v-for="noticia in props.noticias"
            class="news_container flex flex-col gap-4 self-center w-2/3 p-4 rounded max-h-96 mb-4"
          >
            <LinkButton :href="route('newspaper.show', noticia)" color="none">
              <div class="continue_reading">
                <p class="text-white font-600 translate-x-2 translate-y-1">
                  Leer &nbsp; >
                </p>
              </div>
            </LinkButton>
            <div class="flex">
              <LinkButton :href="route('newspaper.show', noticia)" color="none">
                <div
                  class="new_img min-w-80 min-h-80 max-h-80 max-w-80 bg-slate-500 rounded"
                ></div>
              </LinkButton>

              <div class="new_content">
                <h3 class="font-bold">{{ noticia.title }}</h3>
                <p class="text-sm font-bold mb-4">
                  {{ noticia.user.name }}
                </p>
                <p class="text-justify">{{ noticia.content }}</p>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.news_container {
  background: #aaa;

  .continue_reading {
    position: absolute;
    background-color: #333;
    width: 5rem;
    height: 2rem;
    z-index: 15;
    transform: translateX(43.3rem) translateY(-1.5rem);
    transition: all 0.2s;

    &::before {
      content: '';
      position: absolute;
      top: 2rem;
      right: 0;
      width: 10px;
      height: 10px;
      background-color: #111;
      clip-path: polygon(100% 0, 0% 100%, 0 0);
    }

    &:hover {
      transform: translateX(42.9rem) translateY(-1.5rem) scale(1.2);
    }
  }

  .new_img {
    box-shadow: 0 0 5rem #444 inset;
    transition: 0.2s;

    &:hover {
      transform: scale(1.03);
    }
  }
  .new_content {
    overflow: hidden;
    max-height: 20rem;
    position: absolute;
    max-width: 22rem;
    transform: translateX(23rem);

    p {
      color: #333;
    }
  }
}
</style>
