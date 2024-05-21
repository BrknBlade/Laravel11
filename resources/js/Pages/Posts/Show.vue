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
  comments: Array,
})

const form = useForm({
  content: '',
})

const submit = () => {
  form.post(route('posts.comments.store', props.post), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  })
}
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
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center"
        >
          <article
            class="bg-slate-600 p-4 relative text-white rounded"
            style="width: 640px"
          >
            <LinkButton
              :href="route('posts.index')"
              color="none"
              class="exit_post"
              preserveScroll
            ></LinkButton>
            <p class="text-2xl font-bold">{{ post.title }}</p>
            <p class="underline">{{ post.user.name }}</p>
            <img src="./img/dias-entrenar.webp" class="rounded my-4" />
            <p>{{ post.content }}</p>

            <!-- Comments Section -->
            <div class="w-full bg-slate-300 p-4 rounded mt-4 text-black">
              <form @submit.prevent="submit" class="flex flex-col">
                <nav>
                  <InputLabel for="title" value="Comentario" />
                  <TextInput
                    v-model="form.content"
                    id="title"
                    class="w-full"
                    placeholder="Como te sientes hoy..."
                  />
                  <InputError />
                </nav>
                <PrimaryButton class="self-center mt-4">Comentar</PrimaryButton>
              </form>
              <div
                v-for="comment in props.comments"
                class="p-4 bg-slate-700 rounded text-white mt-2 flex flex-col gap-2"
              >
                <p class="text-sm text-slate-400 underline">
                  {{ comment.user.name }}
                </p>
                <p class="text-lg">{{ comment.content }}</p>
                <p class="text-xs text-slate-400 font-bold">
                  {{ comment.created_at }}
                </p>
                <LinkButton
                  v-if="comment.user.id === $page.props.auth.user.id"
                  :href="
                    route('posts.comments.destroy', [props.post.id, comment])
                  "
                  method="delete"
                  as="button"
                  class="self-start"
                  >Borrar</LinkButton
                >
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.exit_post {
  &::before {
    content: 'X';
    cursor: pointer;
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10;
    background: red;
    min-width: 50px;
    min-height: 50px;
    top: 0;
    right: 0;
    border-radius: 0 4px;
  }
}
</style>
