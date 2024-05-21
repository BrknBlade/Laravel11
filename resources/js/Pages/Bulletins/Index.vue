<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LinkButton from '@/Components/LinkButton.vue'
import paper from '@/Pages/Bulletins/Sounds/paper.mp3'
import paper2 from '@/Pages/Bulletins/Sounds/paper2.mp3'

defineProps({
  bulletins: Array,
})

let toggledBulletin = ref(null)
let isClicked = ref(false)

const audio = new Audio(paper)
const audio2 = new Audio(paper2)

const toggleBulletin = (bulletinId) => {
  if (toggledBulletin.value === bulletinId) {
    toggledBulletin.value = null
    audio2.play()
  } else {
    toggledBulletin.value = bulletinId
    audio.play()
  }
  blurBackground()
}

const blurBackground = () => {
  if (isClicked === true) {
    isClicked = false
  } else {
    isClicked = true
  }
}
</script>

<template>
  <Head title="Boletines" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Boletines
      </h2>
    </template>

    <div class="py-12">
      <div class="w-full mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center"
        >
          <LinkButton :href="route('bulletins.create')"
            >Subir un anuncio</LinkButton
          >
          <div
            class="blur_screen"
            :class="{ show_blur_screen: isClicked }"
          ></div>
          <div class="flex flex-wrap gap-4">
            <article
              v-for="bulletin in bulletins"
              class="bulletin_container flex flex-col items-center"
            >
              <div
                v-if="bulletin.status.label === 'Aceptado'"
                class="closed_bulletin"
                :class="{ opened_bulletin: toggledBulletin === bulletin.id }"
              >
                <p class="category" @click="toggleBulletin(bulletin.id)">
                  {{ bulletin.category }}
                </p>
                <div class="title">
                  <p>{{ bulletin.title }}</p>
                </div>
                <div class="content_container">
                  <p class="content">{{ bulletin.content }}</p>
                  <LinkButton
                    :href="route('bulletins.show', bulletin)"
                    color="none"
                  >
                    <img
                      src="./img/image.png"
                      alt="service_img"
                      class="bulletin_img"
                    />
                  </LinkButton>
                </div>
                <nav
                  v-if="bulletin.user_id === $page.props.auth.user.id"
                  class="nav_buttons"
                >
                  <LinkButton :href="route('bulletins.edit', bulletin)"
                    >Editar</LinkButton
                  >
                  <LinkButton
                    :href="route('bulletins.destroy', bulletin)"
                    method="delete"
                    as="button"
                    color="danger"
                    >Eliminar</LinkButton
                  >
                </nav>
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu+Sans+Mono:ital,wght@0,400..700;1,400..700&display=swap');

.closed_bulletin {
  font-family: 'Ubuntu Sans Mono', monospace;
  width: 24rem;
  height: 24rem;
  position: relative;
  background: linear-gradient(to top right, #9b8139, #f7cc55);
  margin-top: 1rem;
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: justify;
  shape-outside: none;
  transition: all 0.2;
  animation-name: closed;
  animation-duration: 0.2s;

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
    top: 0;
    background: #2f773f;
    color: white;
    width: 100%;
    text-align: center;
  }

  .title {
    margin: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.2rem;
    color: white;
    background-color: #9b8139;
    width: 60%;
    text-align: center;
  }

  .content_container {
    .bulletin_img {
      display: none;
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
  }

  .nav_buttons {
    position: absolute;
    bottom: 10px;
    display: flex;
    gap: 10px;
  }
}

.opened_bulletin {
  width: 50rem;
  height: 30rem;
  position: fixed;
  z-index: 60;
  top: 10%;
  left: 20%;
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
    width: 100%;
    height: 3rem;
    margin: 0;
    padding: 1rem;
    border-radius: 0.5rem;
    color: white;
    font-weight: 600;
    font-size: 1.05rem;

    p {
      transform: translateX(-8rem);
    }
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
      transition: all 0.2s;

      &:hover {
        transform: scale(1.05);
      }

      &:active {
        transform: scale(0.99);
      }
    }

    .content {
      overflow: hidden;
      text-align: justify;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 20;
      line-clamp: 2;
      -webkit-box-orient: vertical;
      width: 70%;
    }
  }

  .nav_buttons {
    position: absolute;
    display: flex;
    gap: 0.5rem;
    bottom: 10px;
    left: 10px;
  }
}

.blur_screen {
  position: fixed;
  display: none;
  top: 0;
  min-height: 100vh;
  min-width: 100vw;
  background: #000b;
  z-index: 50;
  /* filter: blur(5px); */

  &.show_blur_screen {
    display: flex;
  }
}

@keyframes open {
  0% {
    width: 25rem;
    color: transparent;
  }

  90% {
  }

  100% {
    width: 50rem;
  }
}

@keyframes closed {
  0% {
    width: 50rem;
    color: transparent;
  }

  50% {
    color: transparent;
  }
  100% {
    width: 25rem;
  }
}
</style>
