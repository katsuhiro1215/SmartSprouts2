<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

import AdminHeader from "@/Layouts/AdminHeader.vue";
import AdminFooter from "@/Layouts/AdminFooter.vue";

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import GridMenu from '@/Components/GridMenu.vue';
import { mdiChevronUp, mdiChevronDown } from '@mdi/js';

const showingNavigationDropdown = ref(false);

const isHeaderCenterVisible = ref(true);

const toggleHeaderCenter = () => {
  isHeaderCenterVisible.value = !isHeaderCenterVisible.value;
};
</script>

<template>

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