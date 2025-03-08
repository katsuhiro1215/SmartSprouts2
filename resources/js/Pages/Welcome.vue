<script setup>
import { Head, Link } from '@inertiajs/vue3';
// Layouts
import GuestLayout from '@/Layouts/GuestLayout.vue';

import Loading from '@/Components/Loading.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Button from '@/Components/Buttons/Button.vue';

import HeroSection from '@/Pages/Section/HeroSection.vue';
import NewsSection from '@/Pages/Section/NewsSection.vue';
import AboutSection from '@/Pages/Section/AboutSection.vue';
import ServiceSection from '@/Pages/Section/ServiceSection.vue';

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <Head title="Welcome" />

  <GuestLayout>
    <HeroSection />
    <InfoSection />
    <AboutSection />
    <ServiceSection />
    <NewsSection />
  </GuestLayout>
</template>
