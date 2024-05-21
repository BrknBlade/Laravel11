<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'
import Button from '@/Components/Button.vue'

defineProps({
  bulletins: Array,
})

const statusForm = useForm({
  status: '',
})

const changeStatus = (bulletin, status) => {
  statusForm
    .transform((data) => ({
      ...data,
      status: status,
    }))
    .patch(route('admin.bulletins.update', bulletin), { preserveScroll: true })
}
</script>

<template>
  <Head title="Admin - Bulletins" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Admin - Bulletins
      </h2>
    </template>

    <div class="py-12">
      <div class="w-full mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center"
        >
          <LinkButton :href="route('admin.bulletins.create')"
            >Subir un anuncio</LinkButton
          >
          <div
            class="flex flex-wrap gap-4 justify-center mt-4 overflow-visible"
          >
            <article v-for="bulletin in bulletins" class="bulletin">
              <p
                class="my-2 px-2 py-1 rounded"
                :style="`background: ${bulletin.status.color};`"
              >
                {{ bulletin.status.label }}
              </p>
              <p class="title">{{ bulletin.title }}</p>
              <p class="category">{{ bulletin.category }}</p>
              <p class="content">{{ bulletin.content }}</p>
              <div class="action_buttons">
                <Button
                  v-if="
                    bulletin.status.label === 'Denegado' ||
                    bulletin.status.label === 'Pendiente'
                  "
                  color="info"
                  @click="changeStatus(bulletin, 'accepted')"
                  >Aceptar</Button
                >
                <Button
                  v-if="
                    bulletin.status.label === 'Aceptado' ||
                    bulletin.status.label === 'Pendiente'
                  "
                  color="danger"
                  @click="changeStatus(bulletin, 'denied')"
                  >Denegar</Button
                >
              </div>
              <LinkButton
                :href="route('admin.bulletins.show', bulletin)"
                color="none"
              >
                <div class="view"></div>
              </LinkButton>
            </article>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu+Sans+Mono:ital,wght@0,400..700;1,400..700&display=swap');

.bulletin {
  font-family: 'Ubuntu Sans Mono', monospace;
  font-weight: 600;
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  background: linear-gradient(to top right, #9b8139, #f7cc55);
  padding: 2rem;
  width: 400px;
  height: 400px;
  clip-path: polygon(90% 0, 100% 10%, 100% 100%, 0 100%, 0 0);
  overflow: visible;
  transition: all 0.2s;

  &::after {
    content: '';
    position: absolute;
    background-color: #9b8139;
    clip-path: polygon(0 0, 100% 100%, 0 100%);
    width: 3rem;
    height: 3rem;
    top: -7px;
    right: -7px;
  }

  .title {
    width: 85%;
    border-radius: 0.2rem;
    background: #9b8139;
    padding: 0.5rem 1rem;
    text-align: center;
    margin-bottom: 0.5rem;
  }

  .category {
    position: absolute;
    z-index: 10;
    background-color: #2f773f;
    color: white;
    font-weight: 400;
    top: 0;
    left: 0;
    width: 90%;
    text-align: center;
  }

  .content {
    overflow: hidden;
    text-align: justify;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 8;
    line-clamp: 2;
    -webkit-box-orient: vertical;
  }

  .action_buttons {
    position: absolute;
    bottom: 10px;
    display: flex;
    gap: 0.5rem;
  }

  .view {
    position: absolute;
    bottom: 10px;
    right: 10px;
    width: 2.5rem;
    height: 2rem;
    clip-path: polygon(
      0% 20%,
      60% 20%,
      60% 0%,
      100% 50%,
      60% 100%,
      60% 80%,
      0% 80%
    );
    background: #9b8139;
    transition: all 0.2s;

    &:hover {
      cursor: pointer;
      animation-name: view_arrow;
      animation-duration: 2s;
      animation-iteration-count: infinite;
      width: 3rem;
      height: 2.5rem;
    }
  }
}

@keyframes view_arrow {
  0% {
    transform: translateX(0);
  }

  20% {
    transform: translateX(5px);
  }

  80% {
    transform: translateX(-5px);
  }

  100% {
    transform: translateX(0);
  }
}
</style>
