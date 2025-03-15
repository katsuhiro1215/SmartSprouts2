<script setup>
import { Link } from '@inertiajs/vue3';
// Components
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Card from '@/Components/Cards/Card.vue';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <Link href="/">
            <ApplicationLogo class="w-20 h-20 fill-current text-green-500" />
        </Link>
        <Card class="border-none min-w-80 max-w-[400px]">
            <template #content>
                <slot />
            </template>
        </Card>
    </div>
</template>
