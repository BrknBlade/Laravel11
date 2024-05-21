<script setup>
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'

const props = defineProps({
  noticia: Object,
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
          <article class="paper w-2/3 rounded h-auto p-4 flex flex-col">
            <LinkButton :href="route('newspaper.index')" color="none">
              <div class="backward"></div>
            </LinkButton>
            <h2 class="text-center text-xl font-bold">{{ noticia.title }}</h2>
            <div
              class="new_img min-w-80 min-h-80 max-h-80 max-w-80 bg-slate-500 rounded self-center mt-4 mb-4"
            ></div>
            <p class="text-justify self-center" style="width: 80%">
              {{ noticia.content }}
            </p>
          </article>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.paper {
  position: relative;
  background: linear-gradient(to bottom, #ddd, #999);
  animation: startreading 0.3s linear;
}

.backward {
  position: absolute;
  top: 0;
  left: 0;
  width: 40px;
  height: 40px;
  background-color: #444;
  border-bottom-right-radius: 1rem;
  transition: all 0.2s;

  &::before {
    content: '';
    position: absolute;
    top: 0.9rem;
    left: 0.8rem;
    z-index: 10;
    background-color: #eee;
    width: 10px;
    height: 2px;
    transform: rotate(-45deg);
    border-radius: 1rem;
  }

  &::after {
    content: '';
    position: absolute;
    top: 1.3rem;
    left: 0.8rem;
    z-index: 10;
    background-color: #eee;
    width: 10px;
    height: 2px;
    transform: rotate(45deg);
    border-radius: 1rem;
  }

  &:hover {
    transform: scale(1.3) translateX(4px) translateY(4px);
  }
}

.new_img {
  box-shadow: 0 0 5rem #444 inset;
  transition: 0.2s;
}

@keyframes startreading {
  0% {
    transform: scale(0.8);
    filter: blur(5px);
    background: #666;
  }
  50% {
    background: #888;
  }
}
</style>
