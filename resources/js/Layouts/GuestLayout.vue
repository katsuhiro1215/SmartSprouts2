<script setup>
// Layouts
import Header from '@/Layouts/Header.vue';
import Footer from '@/Layouts/Footer.vue';
// Pages
import Banner from '@/Pages/Aside/Banner.vue';
import Contact from '@/Pages/Aside/Contact.vue';
</script>

<template>
  <div class="min-h-screen flex flex-col">
    <Header />
    <main class="relative w-full">
      <slot />
    </main>
    <Banner />
    <Contact />
    <Footer />
  </div>
</template>
