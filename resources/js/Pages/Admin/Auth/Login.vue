<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
// Layouts
import AuthLayout from '@/Layouts/AuthLayout.vue';
// Components
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
// Components - Forms
import InputLabel from '@/Components/Forms/InputLabel.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import InputError from '@/Components/Forms/InputError.vue';
import Checkbox from '@/Components/Forms/Checkbox.vue';

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('admin.login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <AuthLayout>
    <Head title="Log in" />
    <!-- ::before content ""  -->
    <div class="flex-1">
      <form @submit.prevent="submit">
        <div class="space-y-4">
            <div class="space-y-2">
              <InputLabel for="email" value="Email" required />
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
            <div class="space-y-2">
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
            <div class="block mt-4">
              <label class="flex items-center">
                <Checkbox name="remember" v-model:checked="form.remember" />
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
              </label>
            </div>
            <div class="flex items-center justify-end mt-4">
            <Link
                v-if="canResetPassword"
                :href="route('admin.password.request')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Forgot your password?
            </Link>

            <PrimaryButton
                class="ms-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Log in
            </PrimaryButton>
            </div>
        </div>
      </form>
    </div>
  </AuthLayout>
</template>