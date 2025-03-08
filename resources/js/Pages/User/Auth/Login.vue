<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

import GuestLayout from "@/Layouts/GuestLayout.vue";

import InputLabel from "@/Components/Forms/InputLabel.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import Checkbox from "@/Components/Forms/Checkbox.vue";
import InputError from "@/Components/Forms/InputError.vue";
import Button from "@/Components/Buttons/Button.vue";
import SocialButton from "@/Components/Buttons/SocialButton.vue";

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
  errors: {},
  processing: false,
});

const isOAuth = ref(false);

const handleOAuthLogin = (provider) => {
  isOAuth.value = true;
  window.location.href = `/auth/${provider}`;
};

const submit = () => {
  form.post(route("user.login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Log in" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div class="flex flex-col space-y-4">
        <div v-if="!isOAuth" class="mb-3">
          <InputLabel for="email" value="Email" />
          <TextInput
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="form.email"
            required
            autofocus
            autocomplete="username"
          />
          <InputError class="mt-2" :message="form.errors.email" />
        </div>
        <div v-if="!isOAuth" class="mb-3">
          <InputLabel for="password" value="Password" />
          <TextInput
            id="password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password"
            required
            autocomplete="current-password"
          />
          <InputError class="mt-2" :message="form.errors.password" />
        </div>
        <div v-if="!isOAuth" class="mb-3">
          <label class="flex items-center">
            <Checkbox name="remember" v-model:checked="form.remember" />
            <span class="ms-2 text-sm text-gray-600">Remember me</span>
          </label>
        </div>
        <div class="flex items-center justify-end mt-4">
          <Link
            v-if="canResetPassword"
            :href="route('user.password.request')"
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Forgot your password?
          </Link>

          <Button
            class="ms-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing || isOAuth"
          >
            Log in
          </Button>
        </div>
        <hr />
        <div class="mb-3">
          <SocialButton
            provider="google"
            @click="handleOAuthLogin('google')"
            :disabled="form.processing"
          />
        </div>
      </div>
    </form>
  </GuestLayout>
</template>
