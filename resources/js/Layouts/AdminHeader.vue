<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { mdiChevronUp, mdiChevronDown } from '@mdi/js';
// Components
import AdminHeaderNavigation from '@/Components/Navigations/AdminHeaderNavigation.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';
import GridMenu from '@/Components/GridMenu.vue';
// Components - Forms
import TextInput from '@/Components/Forms/TextInput.vue';
import Button from '@/Components/Buttons/Button.vue';
// Icons
import Magnify from 'vue-material-design-icons/Magnify.vue';

const showingNavigationDropdown = ref(false);
const isHeaderCenterVisible = ref(true);
const toggleHeaderCenter = () => {
  isHeaderCenterVisible.value = !isHeaderCenterVisible.value;
};
</script>

<template>
  <header class="w-full z-50">
    <!-- Header Top -->
    <div class="w-full h-12 flex justify-between items-center px-4">
      <div class="flex justify-start items-center gap-4">
        <!-- icon -->
        <GridMenu />
        <!-- Logo -->
        <h1 class="text-green-700 font-bold">
          <a href="" class="flex items-center gap-2">
            <ApplicationLogo width="32" />
            <span>Smart Srpouts</span>
          </a>
        </h1>
        <nav>
          <ul class="flex gap-4">
            <li>
              <NavLink href="">
                <img src="/upload/notification.png" alt="" width="24" />
              </NavLink>
            </li>
            <li>
              <NavLink href="">
                <img src="/upload/gestures.png" alt="" width="24" />
              </NavLink>
            </li>
            <li></li>
          </ul>
        </nav>
        <div class="flex justify-end items-center gap-4">
          <Button buttonActionType="button" buttonType="warning"
            >イベントログ</Button
          >
          <Button buttonActionType="button" buttonType="danger"
            >警報ログ</Button
          >
        </div>

      </div>
      <div class="flex items-center">
        <nav
          class="w-full h-16 flex justify-between items-center bg-white border-b-2 border-slate-300 shadow-lg"
        >
          <ul class="flex items-center gap-4">
            <!-- menu toggle -->
            <li>
              <button
                @click="showingNavigationDropdown = !showingNavigationDropdown"
                class="flex items-center justify-center h-16 w-16"
              >
                <svg
                  class="w-6 h-6 text-gray-600"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16m-7 6h7"
                  ></path>
                </svg>
              </button>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- Header Center -->
    <transition name="slide-fade">
      <AdminHeaderNavigation v-if="isHeaderCenterVisible" />
    </transition>
    <!-- Header Bottom -->
    <div class="w-full h-6 flex justify-center bg-white">
      <button @click="toggleHeaderCenter" type="button" class="px-6 bg-orange-400 rounded-sm">
        <svg :width="24" :height="24" viewBox="0 0 24 24">
          <path :d="isHeaderCenterVisible ? mdiChevronUp : mdiChevronDown" />
        </svg>
      </button>
    </div>
  </header>
</template>

<style scoped>
/* Transition for sliding up/down */
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: height 0.3s ease, opacity 0.3s ease;
}

.slide-fade-enter,
.slide-fade-leave-to {
  height: 0;
  opacity: 0;
}

.slide-fade-enter-from,
.slide-fade-leave-active {
  height: 6rem; /* Adjust according to the height of your Header Center */
  opacity: 1;
}
</style>