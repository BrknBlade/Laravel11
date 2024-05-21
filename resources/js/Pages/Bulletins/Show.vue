<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({
  bulletin: Object,
  comments: Array,
})

const form = useForm({
  content: '',
})

const submit = () => {
  form.post(route('bulletins.comments.store', props.bulletin), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  })
}
</script>

<template>
  <Head title="Contact" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Contact</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center"
        >
          <article class="bulletin">
            <p class="category">{{ bulletin.category.name }}</p>
            <p class="title">{{ bulletin.title }}</p>
            <div class="content_container">
              <p>{{ bulletin.content }}</p>
              <img src="./img/image.png" />
            </div>
            <section class="comments_container">
              <form @submit.prevent="submit" class="w-full flex flex-col">
                <InputLabel
                  for="content"
                  value="Contenido"
                  class="text-white text-lg mb-1"
                />
                <TextInput
                  id="content"
                  v-model="form.content"
                  class="w-full text-black mb-2"
                  placeholder="Te interesa?"
                />
                <InputError :message="form.errors.content" />

                <PrimaryButton class="self-center">Enviar</PrimaryButton>
              </form>
              <div v-for="comment in comments" class="comments">
                <p class="underline">{{ comment.user.name }}</p>
                <p>{{ comment.content }}</p>
              </div>
            </section>
          </article>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.bulletin {
  width: 50rem;
  position: relative;
  background: linear-gradient(to top right, #9b8139, #f7cc55);
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: justify;
  shape-outside: none;
  transition: all 0.2;
  animation-name: open;
  animation-duration: 0.2s;
  clip-path: polygon(3rem 0, 120% 0, 100% 100%, 0 100%, 0 3rem);

  &::before {
    content: '';
    position: absolute;
    width: 3rem;
    height: 3rem;
    background: linear-gradient(to bottom right, #d1af4f, #9b8139);
    top: 0;
    left: 0;
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
    display: flex;
    align-items: center;
    justify-content: center;
    width: 90%;
    height: 3rem;
    border-radius: 0.5rem;
    margin-top: 1rem;
    margin-bottom: 1rem;
    color: white;
    font-size: 1.1rem;
    font-weight: 700;
  }

  .content_container {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 2rem;

    p {
      max-width: 60%;
    }

    img {
      width: 30%;
      border-radius: 1rem;
    }
  }

  .comments_container {
    background: #816b30;
    background: linear-gradient(to bottom, #816b30, #74602b);
    color: white;
    padding: 1.5rem;
    border-radius: 1rem;
    width: 90%;

    .comments {
      display: flex;
      box-sizing: border-box;
      padding: 1rem;
      border-radius: 1rem;
      border: 2px solid #222;
      flex-direction: column;
      color: black;
      background: linear-gradient(to bottom left, #a3883e, #d1af4f);
      min-height: 7rem;
      margin-top: 1rem;

      &::before {
        content: '';
        position: absolute;
        background-color: transparent;
        border: 4px solid black;
        width: 3rem;
        height: 1rem;
        transform: translateX(-1.5rem) translateY(-1rem);
      }
    }
  }
}
</style>
