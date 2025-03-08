<script setup>
import { ref, onMounted } from 'vue';

const currentYear = ref(new Date().getFullYear());

onMounted(() => {
  currentYear.value = new Date().getFullYear();
});
</script>

<template>
  <footer class="relative w-full bg-slate-900 text-center mt-auto space-y-4">
    <p class="mb-0">
      <a href="https://katsucode.jp" class="text-white">
        システムに関するお問い合わせはこちらからお願いします。
      </a>
    </p>
    <div class="border-t border-slate-800 py-2">
      <div class="container">
        {{ currentYear }} &copy; Smart Sprouts theme by 
        <a href="https://katsucode.jp/" class="text-green-400">Katsucode</a>
      </div>
    </div>
  </footer>
</template>
