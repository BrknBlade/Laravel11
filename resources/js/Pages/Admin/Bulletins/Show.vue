<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'
import Button from '@/Components/Button.vue'

defineProps({
  bulletin: Object,
  comments: Array,
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
    .patch(route('admin.bulletins.update', bulletin), {
      preserveScroll: true,
    })
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
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center"
        >
          <article class="container flex flex-col items-center">
            <p class="category">{{ bulletin.category }}</p>
            <p class="title">{{ bulletin.title }}</p>
            <p
              class="my-2 px-2 py-1 rounded"
              :style="`background: ${bulletin.status.color};`"
            >
              {{ bulletin.status.label }}
            </p>
            <div class="content_container">
              <p class="content">{{ bulletin.content }}</p>
              <img src="./img/image.png" class="bulletin_img" />
            </div>
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
              <LinkButton :href="route('admin.bulletins.index')"
                >Salir</LinkButton
              >
            </div>

            <div class="comment_container">
              <div v-for="comment in comments" class="comment">
                <p class="opacity-75 underline">{{ comment.user.name }}</p>
                <p class="w-full">{{ comment.content }}</p>
                <p class="opacity-75 underline">{{ comment.created_at }}</p>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.container {
  width: 50rem;
  position: relative;
  background: linear-gradient(to top right, #9b8139, #f7cc55);
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: justify;
  shape-outside: none;

  &::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 3.04rem;
    height: 3.04rem;
    background: white;
    z-index: 15;
  }

  &::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 3rem;
    height: 3rem;
    background: #9b8139;
    clip-path: polygon(100% 0, 0% 100%, 100% 100%);
    z-index: 20;
  }

  .category {
    position: absolute;
    width: auto;
    top: 10px;
    right: 0;
    padding: 0.5rem 2rem;
    background: linear-gradient(to left, #2f773f, #48ac5e);
    transform: translateX(1.2rem);
    color: white;

    &::after {
      content: '';
      position: absolute;
      background-color: #286636;
      clip-path: polygon(100% 0, 0% 0%, 0% 100%);
      width: 20px;
      height: 20px;
      transform: translateY(2rem) translateX(0.8rem);
    }
  }
  .title {
    background-color: #9b8139;
    width: 95%;
    height: 3rem;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    border-radius: 0.5rem;
    color: white;
    font-weight: 600;
    font-size: 1.05rem;
  }

  .content_container {
    display: flex;
    width: 95%;
    margin-top: 1rem;
    gap: 1rem;

    .bulletin_img {
      width: 15rem;
      border-radius: 0.5rem;
      display: flex;
      justify-self: right;
    }
  }

  .action_buttons {
    position: absolute;
    bottom: 10px;
    display: flex;
    gap: 0.5rem;
  }
}

.comment_container {
  background-color: #8b7434;
  padding: 30px;
  border-radius: 1rem;
  margin-top: 1.5rem;
  margin-bottom: 2rem;
  width: 95%;

  .comment {
    background-color: #9b8139;
    margin-bottom: 1rem;
    padding: 1rem;
    border-radius: 1rem;
    color: white;
  }
}
</style>
