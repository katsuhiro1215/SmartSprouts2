<script setup>
import { ref, onMounted } from 'vue';
import { Link } from "@inertiajs/vue3";
// Components
import HeaderNavigation from "@/Components/Navigations/HeaderNavigation.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
// Icons
import WeatherNight from 'vue-material-design-icons/WeatherNight.vue';
import WhiteBalanceSunny from 'vue-material-design-icons/WhiteBalanceSunny.vue';
import Button from "@/Components/Buttons/Button.vue";
import { setThemeOnLoad ,switchTheme } from "@/theme";

const isDarkMode = ref(false);

const handleSwitchTheme = () => {
  switchTheme();
  isDarkMode.value = !isDarkMode.value;
};

onMounted(() => {
  setThemeOnLoad();
  isDarkMode.value = document.documentElement.classList.contains('dark');
});
</script>

<template>
  <header class="w-full h-16 border-b-2">
    <div class="w-full h-full flex items-center justify-between px-4 md:px-6 py-4">
      <div class="h-full flex items-center gap-2">
        <ApplicationLogo class="h-10 w-10" />
        <h1 class="text-xl font-semibold text-primary">Smart Sprouts</h1>
      </div>
      <div class="flex items-center gap-4">
        <HeaderNavigation />
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
          <Link
            v-if="$page.props.auth.user"
            :href="route('user.dashboard')"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >Dashboard</Link
          >
          <template v-else>
            <Link
              :href="route('user.login')"
              class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
              >Log in</Link
            >
            <Link
              v-if="canRegister"
              :href="route('user.register')"
              class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
              >Register</Link
            >
          </template>
        </div>

        <!-- ライトモードとダークモードの切り替え -->
         <div class="flex items-center">
          <Button buttonType="ghost" class="size-10" @click="handleSwitchTheme">
            <WhiteBalanceSunny class="text-slate-900" v-if="!isDarkMode" />
            <WeatherNight class="text-white" v-if="isDarkMode" />
          </Button>
         </div>
      </div>
    </div>
  </header>
</template>