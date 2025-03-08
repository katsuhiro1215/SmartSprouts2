<script setup>
import NewsTicker from '@/Components/NewsTicker.vue';
import Button from '@/Components/Buttons/Button.vue';
</script>

<template>
  <div class="relative w-full h-[640px] flex items-center gap-5 bg-gradient-to-br from-emerald-200 to-blue-300">
    <div class="w-1/2 pl-14 space-y-4">
      <h1 class="text-4xl font-bold">Smart Sprouts</h1>
      <p class="text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt nam rem illum vel exercitationem quibusdam fugit tempore autem pariatur dolorem.</p>
      <div class="flex gap-4">
        <Button buttonType="primary">Login</Button>
        <Button buttonType="info">Register</Button>
      </div>
    </div>
    <div class="relative w-1/2 h-[640px]">
      <div
        class="absolute top-6 bg-pink-200 right-0 w-full h-[592px] rounded-tl-2xl rounded-bl-2xl"
      >
        <img src="/upload/image.jpg" alt="" class="absolute top-0 left-0 w-full h-full object-cover" />
      </div>
    </div>
    <NewsTicker />
  </div>
</template>
