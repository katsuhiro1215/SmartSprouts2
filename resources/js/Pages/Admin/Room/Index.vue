<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Card from "@/Components/Cards/Card.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Room</h2>
    </template>
    <div class="w-full space-y-6">
      <div class="grid grid-cols-4 gap-6">
        <!-- Header -->
        <Card
          header="Header content here"
          title="Card Title"
          description="This is a description of the card."
          footer="Footer content here"
        >
          <template #header> </template>
          <template #content>
            <p>
              This is the main content of the card, which can include any HTML
              or component.
            </p>
          </template>

          <template #footer>
            <Button
              buttonActionType="button"
              buttonType="info"
              >登録</Button
            >
          </template>
        </Card>
      </div>
      <div class="flex flex-wrap gap-4">
        <div
          class="relative w-40 h-40 bg-green-400 rounded-lg p-4 ring-offset-0 ring-0 active:ring-offset-2 active:ring-4 cursor-pointer"
        >
          <span
            class="w-10 h-10 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 border rounded-full text-3xl text-slate-500 text-center"
            >A</span
          >
        </div>
        <div class="relative w-40 h-40 bg-green-400 rounded-lg p-4">
          <span
            class="w-10 h-10 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 border rounded-full text-3xl text-slate-500 text-center"
            >A</span
          >
        </div>
        <div class="relative w-40 h-40 bg-green-400 rounded-lg p-4">
          <span
            class="w-10 h-10 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 border rounded-full text-3xl text-slate-500 text-center"
            >A</span
          >
        </div>
        <div class="relative w-40 h-40 bg-green-400 rounded-lg p-4">
          <span
            class="w-10 h-10 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 border rounded-full text-3xl text-slate-500 text-center"
            >A</span
          >
        </div>
        <div class="relative w-40 h-40 bg-green-400 rounded-lg p-4">
          <span
            class="w-10 h-10 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 border rounded-full text-3xl text-slate-500 text-center"
            >A</span
          >
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>