<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Card from "@/Components/Cards/Card.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import InputError from "@/Components/Forms/InputError.vue";
import Textarea from "@/Components/Forms/Textarea.vue";
import Button from "@/Components/Buttons/Button.vue";

const form = useForm({
  name: "",
  description: "",
  component_name: false,
});

const submit = () => {
  form.post(route("admin.widget.store"), {});
};
</script>

<template>
  <Head title="Widgets" />

  <AuthenticatedLayout>
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">Widget</h1>
    </template>

    <div class="w-full">
      <Card>
        <template #content>
          <form @submit.prevent="submit">
            <div class="flex flex-col space-y-4">
              <div class="w-full space-y-2">
                <InputLabel for="name" value="ウィジェット名" />
                <TextInput
                  id="name"
                  type="name"
                  class="mt-1 block w-full"
                  v-model="form.name"
                  required
                  autofocus
                  autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
              </div>
              <div class="w-full space-y-2">
                <InputLabel for="description" value="ウィジェット説明" />
                <Textarea />
                <InputError class="mt-2" :message="form.errors.description" />
              </div>
              <div class="w-full space-y-2">
                <InputLabel for="component_name" value="コンポーネント名" />
                <TextInput
                  id="component_name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.component_name"
                  required
                  autofocus
                  autocomplete="component_name"
                />
                <InputError
                  class="mt-2"
                  :message="form.errors.component_name"
                />
              </div>
              <div class="w-full space-y-2">
                <InputLabel for="default_data" value="初期データ" />
                <InputError class="mt-2" :message="form.errors.default_data" />
              </div>
              <Button>保存</Button>
            </div>
          </form>
        </template>
      </Card>
    </div>
  </AuthenticatedLayout>
</template>